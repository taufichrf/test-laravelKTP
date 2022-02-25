@extends('layouts.master')
@push('css')
<link href="{{ url('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah User</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user_store') }}">
                    @csrf
                    <div class="form-group row">
						<div class="col-sm-6">
							<label for="name">Nama</label>
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama">
							@error('name')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
                    <div class="form-group row">
						<div class="col-sm-6">
							<label for="email">Email</label>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
							@error('email')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-6">
							<label for="is_admin">Jenis Akun</label>
							<select name="is_admin" id="is_admin" class="form-control @error('is_admin') is-invalid @enderror" required autocomplete="is_admin" placeholder="Jenis Akun">
								<option value="0">User</option>
								<option value="1">Administrator</option>
							</select>
							@error('is_admin')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
                    <div class="form-group row">
						<div class="col-sm-6">
							<label for="password">Password</label>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
							@error('password')
							<span class="invalid-feedback" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
                    </div>
                    <div class="form-group row">
						<div class="col-sm-6">
							<label for="password-confirm">Konfirmasi Password</label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
						</div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Simpan User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection