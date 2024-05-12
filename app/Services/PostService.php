<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostService
{
    public function create($data)
    {
        return Post::create($data);
    }

    public function update($post_id, $data)
    {
        return Post::where('post_id','=', $post_id)->update($data);
    }

    public function listQuery()
    {
        $query = Post::orderBy('posts.post_id', 'ASC')->where('status', 'publish');
        return $query;
    }

    public function getPostBySlug($slug)
    {
        return Post::where('slug', $slug)->where( 'status', 'publish' )->first();
    }

    public function getPublishedPost()
    {
        $query = Post::orderBy('posts.post_id', 'ASC')->where( 'status', 'publish' )->get();
        return $query;
    }
}
