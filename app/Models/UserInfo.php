<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'full_name',
        'position_id',
        'mobile_no',
        'address',
        'skills',
        'about_me',
        'profile_img',
        'date_of_birth',
        'admission_date',
        'collage_name',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'uid');
    }
    public function userPosition()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
}
