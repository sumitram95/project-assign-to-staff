<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPages extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name_id',
        'project_page'
    ];

    public function project()
    {
        return $this->belongsTo(ProjectNames::class, 'project_name_id', 'id');
    }

    public function assignProject()
    {
        return $this->hasMany(AssignProjectToEmployee::class, 'project_page_id', 'id');
    }

    public function projectNames()
    {
        return $this->hasMany(ProjectNames::class, 'id', 'project_name_id');
    }

    public function projectSubPages()
    {
        return $this->hasMany(ProjectSubPages::class, 'project_page_id', 'id');
    }
}
