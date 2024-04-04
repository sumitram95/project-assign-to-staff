<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProjectNamesAssignTostaff extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'project_name_id'
    ];

    public function projectNames()
    {
        return $this->hasMany(ProjectNames::class, 'id', 'project_name_id');

    }

    // public function allPivot()
    // {
    //     return $this->hasMany(AssignProjectToEmployee::class, 'project_name_id', 'project_name_id')
    //         ->where('employee_id', Auth::id());
    // }

}
