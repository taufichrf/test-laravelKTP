@extends('layouts.master')
@push('css')
<link href="{{ url('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container">
<p>Selamat Datang, {{ Auth::user()->name }}!<p>
	<div class="col-md-6 col-lg-3">
        <div class="card" id="info-totalPatients">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-team"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{ number_format($totalData) }}</h2>
                        <p class="m-b-0 text-muted">Total Data KTP</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection