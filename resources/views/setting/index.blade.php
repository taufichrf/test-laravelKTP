@extends('layouts.master')

@section('content')
<div class="page-header no-gutters has-tab">
    <h2 class="font-weight-normal">Pengaturan</h2>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="tab-account">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Umum</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('save_user') }}" method="POST">
                        @csrf
                        <div class="form-row align-items-end">
                            <div class="form-group col-md-5">
                                <label class="font-weight-semibold" for="name">Nama lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="User Name" value="{{ Auth::user()->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <label class="font-weight-semibold" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="email" value="{{ Auth::user()->email }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-block btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade show active" id="tab-account">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ubah Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('save_password') }}" method="POST">
                        @csrf
                        <div class="form-row align-items-end">
                            <div class="form-group col-md-4">
                                <label class="font-weight-semibold" for="old_password">Password lama</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password" placeholder="Password lama">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="font-weight-semibold" for="new_password">Password baru</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" placeholder="Password baru">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="font-weight-semibold" for="confirm_password">Konfirmasi password</label>
                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password" placeholder="Konfirmasi password">
                            </div>
                            <div class="form-group col-md-2 ml-auto">
                                <button class="btn btn-block btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $('#openphoto').click(function() {
        $('#photo').trigger('click');
    });

    $('#photo').on('change', function() {
        setImagePreview(this);
    });

    function setImagePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#openphoto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush