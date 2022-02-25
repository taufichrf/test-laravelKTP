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
                        <h4>List User</h4>
                        <p>Di bawah ini merupakan list user yang terdata di dalam sistem.</p>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('user_create') }}" class="btn btn-primary float-right">Tambah User</a>
                    </div>
                </div><br>
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table" id="datatable">
                            <thead>
                                <th>No</th>
                                <th style="width: 25%; text-align: center">Nama</th>
                                <th style="width: 30%; text-align: center">Email</th>
								<th style="width: 25%; text-align: center">Jenis Akun</th>
                                <th style="width: 10px; text-align: center"><i class='anticon anticon-setting'></i></th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="userModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Detail User</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="detail_name"></h4>
                <p id="detail_email"></p>
				<p id="jenis_akun"></p>
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
            order: [1, 'ASC'],
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ route('user_list') }}",
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
                    data: 'email',
                },
				{
					data: 'is_admin',
				},
                {
                    data: 'action'
                }
            ]
        });

        $(document).on('click', '.deleteButton', function() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E7472C'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('user_delete') }}",
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
                url: "{{ route('user_detail') }}",
                method: 'POST',
                data: {
                    id: $(this).data('id'),
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(res) {
					$('#detail_name').html(res.name);
                    $('#detail_email').html(res.email);
					if(res.is_admin == 1){
						$('#jenis_akun').html('Administrator');
					}
					else{
						$('#jenis_akun').html('User');
					}
                    
                    $('#userModal').modal('show');
                }
            });
        })
    })
</script>
@endpush