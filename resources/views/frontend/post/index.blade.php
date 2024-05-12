@include('layouts.topbar_public')
@extends('layouts.master-without-nav')
@section('title') @lang('translation.checkout') @endsection

@section('content')
<style type="text/css">
    .posts_content{
        padding: 15px;
        position: relative;
        top: 110px;
    }
</style>
<div class="row posts_content">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="card-title mb-0">Categories</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        @foreach( $categoriesWithCount as $categorieCount )
                        	<p>
                                <a href="{{ route( 'public.category.view', $categorieCount->slug ) }}">{{ $categorieCount->name }} ( {{ $categorieCount->posts_count }} )</a>   
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="card-title mb-0">Posts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                @if( $getPublishedPosts->count() > 0 )
                    @foreach( $getPublishedPosts as $publishedPost )
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <img src="" onerror="this.src='https://placehold.jp/250x250.png'" alt="Post Image">
                            </div>
                            <div class="col-md-8">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a class="entry-title-link" rel="bookmark" href="{{ route('public.post.view', $publishedPost->slug) }}">{{ ucfirst( $publishedPost->title ) }}</a>
                                    </h2>
                                    <p class="entry-meta">Last updated on <time itemprop="dateModified">{{ datetimeFormat( $publishedPost->updated_at ) }}</time> by <span>Rajat</span></p></header>
                                <h4>{{ readMore( strip_tags( $publishedPost->description ) ) }}</h4>
                            </div>
                        </div>
                        @if( ! $loop->last )
                            <hr>
                        @endif
                    @endforeach
                @else
                    <div class="row mb-3">
                        <h4 class="text-center">No Post Found</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script type="text/javascript"></script>
@endsection
