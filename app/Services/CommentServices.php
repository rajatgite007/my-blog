<?php

namespace App\Services;

use App\Models\Comment;

class CommentServices
{
    public function create($data)
    {
        return Comment::create($data);
    }
}
