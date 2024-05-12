<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    protected $primaryKey = 'tag_id';
    
    protected $fillable = [
        'category_id',
        'name',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id')->where('status', 'publish');
    }
}
