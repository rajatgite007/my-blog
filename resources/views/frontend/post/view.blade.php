@include('layouts.topbar_public')
@extends('layouts.master-without-nav')
@section('title') @lang('translation.checkout') @endsection

@section('content')
<link href="{{ URL::asset('build/css/reaction.css') }}" rel="stylesheet" type="text/css" >
<style type="text/css">
    .posts_content{
        padding: 15px;
        position: relative;
        top: 110px;
    }
   .comment {
    margin-bottom: 20px;
}

.comment p {
    margin-bottom: 10px;
}

.replies {
    margin-left: 20px; /* Adjust the indentation for replies */
}

.reply p {
    margin-bottom: 5px;
}

.form-group {
    margin-bottom: 15px;
}

/* Optional: Style the submit button */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
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
                <span class="reaction-btn"> <!-- Default like button -->
                    <span class="reaction-btn-emo like-btn-default"></span> <!-- Default like button emotion-->
                    <span class="reaction-btn-text">React ( {{ $getPost->reactions->count() ?? 0 }} )</span> <!-- Default like button text,(Like, wow, sad..) default:Like  -->
                    <ul class="emojies-box"> <!-- Reaction buttons container-->
                        @foreach( $reactionArr as $reaction )
                            <a href="{{ route('public.reaction.post', ['post_id' => $getPost->post_id, 'reaction' => $reaction]) }}"><li class="emoji emo-{{ $reaction }}" data-reaction="{{ ucfirst( $reaction ) }}">
                            </li>
                            </a>
                        @endforeach

                    </ul>
                </span>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img src="{{ URL::asset('build/post_images/' . $getPost->img_path) }}" onerror="this.src='https://placehold.jp/250x250.png'" alt="Post Image">
                    </div>
                    <div class="col-md-8">
                        <header class="entry-header">
                            <h1 class="entry-title">
                                {{ ucfirst( $getPost->title ) }}
                            </h1>
                            <p class="entry-meta"> Last updated on <time itemprop="dateModified">{{ datetimeFormat( $getPost->updated_at ) }}</time> by <span>Rajat</span></p></header>
                        <h4>{!! $getPost->description !!}</h4>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <h4>Post Tags</h4>
                    </div>
                    <div class="col-md-8">
                         @foreach($getPost->tags as $tag)
                            <a href="{{ route('public.tag.view', $tag->slug) }}">{{ $tag->name }}</a>{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </div>
                </div>
                <hr>
                <form action="{{ route('public.comment.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $getPost->post_id }}">
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea name="comment" id="comment" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @if( $getPost->count() > 0 )
                    @foreach($getPost->comments as $comment)
                        <div class="comment">
                            <h6 style="color:blue;">Rajat</h6> <!-- Assuming 'name' is the attribute for the user's name -->
                            <p>{{ $comment->comment }}</p>
                            <div class="replies">
                                @foreach($comment->replies as $reply)
                                    <div class="reply">
                                        <h6  style="color:red;">User Reply</h6> <!-- Displaying user's name for each reply -->
                                        <p>{{ $reply->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="replies">
                                <form action="{{ route('public.comment.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $getPost->post_id }}">
                                    <input type="hidden" name="comment_id" value="{{ $comment->comment_id }}">
                                    <div class="form-group">
                                        <textarea name="comment" id="comment" class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Reply</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
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
