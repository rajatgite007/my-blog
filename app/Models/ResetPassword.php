<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $table = 'reset_password';
    protected $primaryKey = 'reset_password_id';

    protected $fillable = [
        'reset_password_id',
        'user_id',
        'date_reset',
        'token',
        'status',//0-inactive, 1-active
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
