<?php

namespace App\Http\Controllers\Backend\DashBoard;

use App\Http\Controllers\BaseController\ErrorLogController;
use App\Models\ProjectNames;

class StaffPersonalTaskController extends ErrorLogController
{
    public function staffGroup($id)
    {
        try {
            $data['project'] = ProjectNames::where('id', $id)->first();
            if ($data['project']) {
                $data['project']->assign_project_count_unique = $data['project']->assignProject->groupBy('employee_id')->count();
                $uniqueEmployees = $data['project']->assignProject->pluck('assignProjectUsers')->flatten()->unique();
                $data['project']->makeHidden('assignProject'); // Hide the assign_project attribute
                $data['uniqueEmployees'] = $uniqueEmployees->values()->all();
            }
            return view('backend.pages.staff-group', $data);
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
}
