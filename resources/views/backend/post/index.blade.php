@extends('layouts.master')
@section('title') @lang('translation.clients') @endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Posts @endslot
        @slot('title') List @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">Posts</h4>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.post.create') }}" class="btn btn-outline-primary"><i class="ri-add-circle-line"></i>New</a>
                    </div>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ $dataTable->scripts() }}
@endsection
