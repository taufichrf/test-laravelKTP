<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data KTP</title>

    <link rel="shortcut icon" href="{{ url('assets/images/logo/favicon.png') }}">
    <!-- <link rel="stylesheet" href="{{ url('css/bootstrap-tour-standalone.min.css') }}"> -->
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet">

    @stack('css')

</head>

<body>
    <div class="app">
        <div class="layout">
            @include('layouts.topbar')
            @include('layouts.sidebar')
            <div class="page-container">

                <div class="main-content">
                    @yield('content')
                </div>

                <footer class="footer">
                    <div class="footer-content">
                        <p class="m-b-0">Copyright © {{ date('Y') }}. All rights reserved.</p>
                        <!-- <span>
                            <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
                            <a href="" class="text-gray">Privacy &amp; Policy</a>
                        </span> -->
                    </div>
                </footer>
            </div>
        </div>
    </div>


    <script src="{{ url('assets/js/vendors.min.js') }}"></script>
    <script src="{{ url('assets/js/app.min.js') }}"></script>
    <script src="{{ url('assets/js/function.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ url('js/bootstrap-tour-standalone.min.js') }}"></script>

    @if(Session::get('success') || Session::get('error'))
    <script>
        $(document).ready(function() {
            @if(Session::get('success'))
            var icon = 'success';
            @endif
            @if(Session::get('error'))
            var icon = 'error';
            @endif

            sweatAlert(icon, "{{ Session::get('success') ?? Session::get('error') }}", "{{ Auth()->user()->name }}");
        });
    </script>
    @endif

    @stack('js')

</body>

</html>