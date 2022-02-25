@extends('layouts.master')
@push('css')
<link href="{{ url('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4>Log Aktivitas</h4>
                        <p>Di bawah ini merupakan log aktivitas yang dilakukan semua user.</p>
                    </div>
                </div><br>
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table" id="datatable">
                            <thead>
                                <th>No</th>
                                <th style="width: 25%; text-align: center">Nama</th>
                                <th style="width: 30%; text-align: center">Aktivitas</th>
								<th style="width: 25%; text-align: center">Waktu</th>
                                <th style="width: 10px; text-align: center"><i class='anticon anticon-setting'></i></th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="activityModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activityModalLabel">Detail Aktivitas</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="detail_name"></h4>
                <p id="activity"></p>
				<p id="time"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ url('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            paginate: true,
            info: true,
            sort: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ route('list_activity') }}",
                method: 'POST'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                    width: '10px'
                },
                {
                    data: 'name',
                },
                {
                    data: 'description',
                },
				{
					data: 'time',
				},
                {
                    data: 'action'
                }
            ]
        });

        $(document).on('click', '.deleteButton', function() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus log aktivitas ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E7472C'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('delete_activity') }}",
                        method: 'DELETE',
                        data: {
                            id: $(this).data('id'),
                        },
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            Swal.fire({
                                title: res.title,
                                text: res.text,
                                icon: res.icon,
                            }).then((result) => {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '.detailButton', function() {
            $.ajax({
                url: "{{ route('detail_activity') }}",
                method: 'POST',
                data: {
                    id: $(this).data('id'),
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
					$('#detail_name').html(res.name);
                    $('#activity').html(res.description);
                    $('#time').html(res.created_at);
					                    
                    $('#activityModal').modal('show');
                }
            });
        })
    })
</script>
@endpush