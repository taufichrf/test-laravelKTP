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
                    <div class="col-md-6">
                        <h4>Data KTP</h4>
                        <p>Di bawah ini merupakan data KTP.</p>
                    </div>
					@if(Auth::user()->is_admin == 1)
						<div class="col-md">
							<button class="btn btn-block btn-success float-right exportButton">Export Data</button>
						</div>
						<div class="col-md-2">
							<button class="btn btn-block btn-warning float-right importButton">Import Data</button>
						</div>
						<div class="col-md-2">
							<a href="{{ route('create_data') }}" class="btn btn-block btn-primary float-right">Tambah Data</a>
						</div>
					@else
						<div class="col-md">
							<button class="btn btn-success float-right exportButton">Export Data</button>
						</div>
					@endif
                </div><br>
				<div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table" id="datatable">
                            <thead>
                                <th>No</th>
                                <th style="width: 20%; text-align: center">NIK</th>
                                <th style="width: 25%; text-align: center">Nama</th>
								<th style="width: 15%; text-align: center">Usia</th>
								<th style="width: 20%; text-align: center">Alamat</th>
                                <th style="width: 10px; text-align: center">@csrf<i class='anticon anticon-setting'></i></th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exportModal">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exportModalLabel">Detail Export Data</h5>
				<button type="button" class="close" data-dismiss="modal">
					<i class="anticon anticon-close"></i>
				</button>
			</div>
			<form method="POST" action="{{ route('export_data') }}">
				@csrf
				<div class="modal-body">
					<label for="tipe_file">Tipe file</label>
					<select name="tipe_file" id="tipe_file" class="form-control @error('tipe_file') is-invalid @enderror" required autocomplete="tipe_file">
						<option value="csv">.CSV</option>
						<option value="pdf">.PDF</option>
					</select>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success float-right" type="submit">Export</a>
				</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="importModal">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="importModalLabel">Detail Import Data</h5>
				<button type="button" class="close" data-dismiss="modal">
					<i class="anticon anticon-close"></i>
				</button>
			</div>
			<form method="POST" enctype="multipart/form-data" action="{{ route('import_data') }}">
				@csrf
				<div class="modal-body">
					<label for="file_import">Pilih file (format .csv)</label>
					<input id="file_import" type="file" class="form-control @error('file_import') is-invalid @enderror" accept=".csv" name="file_import" required>
				</div>
				<div class="modal-footer">
					<button class="btn btn-warning float-right" type="submit">Import</a>
				</div>
			</form>
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
			deferRender: true,
            info: true,
            sort: true,
            processing: true,
            serverSide: true,
            order: [1, 'ASC'],
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ route('list_data') }}",
                method: 'POST',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                    width: '10px'
                },
                {
                    data: 'nik',
                },
                {
                    data: 'nama',
                },
				{
					data: 'tgl_lahir',
				},
				{
					data: 'alamat',
				},
                {
                    data: 'action'
                }
            ]
        });

        $(document).on('click', '.deleteButton', function() {
            Swal.fire({
                title: 'Apakah kamu yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E7472C'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('delete_data') }}",
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
		
		$(document).on('click', '.exportButton', function() {
			$('#exportModal').modal('show');
        });
		
		$(document).on('click', '.importButton', function() {
			$('#importModal').modal('show');
        });
    })
</script>
@endpush