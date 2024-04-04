<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignProjectToEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'project_name_id',
        'project_page_id'
    ];

    public function assignProjectUSers()
    {
        return $this->hasMany(User::class, 'id', 'employee_id');
    }
    public function ProjectNames()
    {
        return $this->hasMany(ProjectNames::class, 'id', 'project_name_id');
    }
    public function getPages()
    {
        return $this->hasMany(ProjectPages::class, 'id', 'project_page_id');
    }

}
