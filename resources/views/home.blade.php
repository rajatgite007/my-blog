@extends('layouts.master')
@section('title') @lang('translation.dashboard') @endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.home') @endslot
        @slot('title') @lang('translation.dashboard') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                  
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
