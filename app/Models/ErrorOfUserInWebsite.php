<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorOfUserInWebsite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'error_id',
        'error_count'
    ];
    public function userErrors()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
