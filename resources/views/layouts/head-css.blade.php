@yield('css')
<!-- Layout config Js -->
<script src="{{ URL::asset('build/js/layout.js') }}"></script>

<!-- Jquery -->
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>

<!-- Select2 and JS Css-->
<link href="{{ URL::asset('build/css/select2.min.css') }}" rel="stylesheet" type="text/css" >
<script src="{{ URL::asset('build/js/select2.full.min.js') }}"></script>

<!-- dataTables -->
<link rel="stylesheet" href="{{ URL::asset('build/css/dataTables.bootstrap5.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ URL::asset('build/css/toastr.min.css') }}">
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ URL::asset('build/css/custom.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
{{-- @yield('css') --}}
