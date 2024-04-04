<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubPages extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_page_id',
        'project_sub_page_name'
    ];

    public function projectPage()
    {
        return $this->belongsTo(ProjectPages::class, 'id', 'project_page_id');
    }
}
