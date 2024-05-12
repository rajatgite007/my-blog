<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'comment_id';
    
    protected $fillable = [
        'comment_id',
        'post_id',
        'user_id',
        'comment',
        'parent_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'comment_id');
    }
}
