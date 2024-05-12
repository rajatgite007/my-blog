<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reactions extends Model
{
    use HasFactory;

    protected $table = 'reactions';
    protected $primaryKey = 'reaction_id';
    
    protected $fillable = [
        'reaction_id',
        'post_id',
        'user_id',
        'reaction_type',
    ];

    protected $hidden = [
    ];
}
