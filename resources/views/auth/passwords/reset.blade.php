@extends('layouts.app')

@section('content')
<div class="row align-items-center w-100">
    <div class="col-md-7 col-lg-5 m-h-auto">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between m-b-30">
                    <img class="img-fluid" alt="" src="{{ url('assets/images/logo/logo-full.svg') }}" width="130">
                    <h2 class="m-b-0">Reset Password</h2>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label class="font-weight-semibold" for="email">Email</label>
                        <div class="input-affix">
                            <i class="prefix-icon anticon anticon-user"></i>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold" for="password">Password</label>
                        <div class="input-affix m-b-10">
                            <i class="prefix-icon anticon anticon-lock"></i>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold" for="password_confirmation">Confirm Password</label>
                        <div class="input-affix m-b-10">
                            <i class="prefix-icon anticon anticon-lock"></i>
                            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between">
                            <button class="btn btn-primary" type="submit">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection