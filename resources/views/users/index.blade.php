@extends('layouts.master')
@section('title') @lang('translation.users') @endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('translation.users') @endslot
        @slot('title') @lang('translation.list') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">@lang('translation.users')</h4>

                    @include('shared.companyFilter', [
                        'company_id' => $company_id, 
                        'activeCompanies' => $activeCompanies
                        ])

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('users.export', ['company_id' => $company_id]) }}" class="btn btn-outline-primary"><i class="ri-file-excel-line"></i> @lang('translation.export')</a>
                        <a href="{{ route('users.add') }}" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i> @lang('translation.new')</a>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    {{ $dataTable->table() }}
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('script')
    {{ $dataTable->scripts() }}

    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
