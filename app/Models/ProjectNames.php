<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProjectNames extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name'
    ];

    public function projectPages()
    {
        return $this->hasMany(ProjectPages::class, 'project_name_id', 'id');
    }
    public function assignProject()
    {
        return $this->hasMany(AssignProjectToEmployee::class, 'project_name_id', 'id');
    }

    public function onlyAuthStaffPivot()
    {
        return $this->hasMany(AssignProjectToEmployee::class, 'project_name_id', 'id')
            ->where('employee_id', Auth::id());
    }
}
