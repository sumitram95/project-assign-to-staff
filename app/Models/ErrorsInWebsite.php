<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorsInWebsite extends Model
{
    use HasFactory;


    protected $fillable = [
        'error',
        'controller_name',
        'method',
        'line_number',
        'code',
        'count_error'
    ];
}
