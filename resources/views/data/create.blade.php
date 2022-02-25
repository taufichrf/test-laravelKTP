@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data KTP</h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('store_data') }}">
                    @csrf
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="nik">NIK</label>
							<input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus placeholder="NIK">
							@error('nik')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
                    <div class="form-group row">
						<div class="col-sm-6">
							<label for="nama">Nama</label>
							<input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus placeholder="Nama">
							@error('nama')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
                    <div class="form-group">
						<label for="tempat_lahir">Tempat, Tanggal Lahir</label>
						<div class="row">
							<div class="col-sm-3">
								<input id="tempat" type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" value="{{ old('tempat') }}" required autocomplete="tempat" placeholder="Tempat">
								@error('tempat')
								<span class="invalid-feedback" role="alert">
									{{ $message }}
								</span>
								@enderror
							</div>
							<div class="col-sm-3">
								<input id="tgl" type="date" class="form-control @error('tgl') is-invalid @enderror" name="tgl" value="{{ old('tgl') }}" required autocomplete="tgl" placeholder="Tanggal lahir">
								@error('tgl')
								<span class="invalid-feedback" role="alert">
									{{ $message }}
								</span>
								@enderror
							</div>
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="foto">Foto (Maks. 1 MB)</label>
							<div class="media align-items-center">
								<div class="avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
									<img src="{{ url('foto/default.png') }}" id="openfoto">
								</div>
								<div>
									<input id="foto" type="file" class="form-control" name="foto" accept="image/*">
								</div>
							</div>
						</div>
                    </div>
                    <div class="form-group row">
						<div class="col-sm-6">
							<label for="jenis_kelamin">Jenis Kelamin</label>
							<select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required autocomplete="jenis_kelamin" placeholder="Jenis Kelamin">
								<option value="1">Laki-laki</option>
								<option value="2">Perempuan</option>
							</select>
							@error('jenis_kelamin')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="gol_darah">Golongan Darah</label>
							<select name="gol_darah" id="gol_darah" class="form-control @error('gol_darah') is-invalid @enderror" required autocomplete="gol_darah" placeholder="Golongan Darah">
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="O">O</option>
								<option value="AB">AB</option>
								<option value="-">Tidak tahu</option>
							</select>
							@error('gol_darah')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="alamat">Alamat</label>
							<input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus placeholder="Alamat">
							@error('alamat')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-3">
							<label for="rt">RT</label>
							<input id="rt" type="text" class="form-control @error('rt') is-invalid @enderror" name="rt" value="{{ old('rt') }}" required autocomplete="rt" placeholder="RT">
							@error('rt')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
						<div class="col-sm-3">
							<label for="rw">RW</label>
							<input id="rw" type="text" class="form-control @error('rw') is-invalid @enderror" name="rw" value="{{ old('rw') }}" required autocomplete="rw" placeholder="RW">
							@error('rw')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="kelurahan">Kelurahan/Desa</label>
							<input id="kelurahan" type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ old('kelurahan') }}" required autocomplete="kelurahan" autofocus placeholder="Kelurahan">
							@error('kelurahan')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="kecamatan">Kecamatan</label>
							<input id="kecamatan" type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ old('kecamatan') }}" required autocomplete="kecamatan" autofocus placeholder="Kecamatan">
							@error('kecamatan')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="agama">Agama</label>
							<select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror" required autocomplete="agama" placeholder="Agama">
								<option value="Islam">Islam</option>
								<option value="Kristen">Kristen</option>
								<option value="Katolik">Katolik</option>
								<option value="Budha">Budha</option>
								<option value="Hindu">Hindu</option>
								<option value="Konghuchu">Konghuchu</option>
							</select>
							@error('agama')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="status">Status Perkawinan</label>
							<select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required autocomplete="status" placeholder="Status Perkawinan">
								<option value="1">Belum Kawin</option>
								<option value="2">Kawin</option>
								<option value="3">Cerai Hidup</option>
								<option value="4">Cerai Mati</option>
							</select>
							@error('status')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="pekerjaan">Pekerjaan</label>
							<input id="pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" value="{{ old('pekerjaan') }}" required autocomplete="pekerjaan" autofocus placeholder="Pekerjaan">
							@error('pekerjaan')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="kewarganegaraan">Kewarganegaraan</label>
							<input id="kewarganegaraan" type="text" class="form-control @error('kewarganegaraan') is-invalid @enderror" name="kewarganegaraan" value="{{ old('kewarganegaraan') }}" required autocomplete="kewarganegaraan" autofocus placeholder="Kewarganegaraan">
							@error('kewarganegaraan')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group">
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('#foto').on('change', function() {
        setImagePreview(this);
    });

    function setImagePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#openfoto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush