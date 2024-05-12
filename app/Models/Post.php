<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    
    protected $fillable = [
        'post_id',
        'user_id',
        'title',
        'description',
        'slug',
        'img_path',
        'status',
        'scheduled_at',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id')->whereNull('parent_id');
    }

    public function reactions()
    {
        return $this->hasMany(Reactions::class, 'post_id');
    }

}
