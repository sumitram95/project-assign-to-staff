<?php

namespace App\Http\Controllers\Backend\DashBoard;

use App\Http\Controllers\BaseController\ErrorLogController;
use App\Models\AssignProjectToEmployee;
use App\Models\ProjectNames;
use App\Models\ProjectNamesAssignTostaff;
use App\Models\ProjectPages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends ErrorLogController
{
    public function projectIndexPage()
    {
        try {
            $data['projects'] = ProjectNames::with([
                'projectPages.assignProject.assignProjectUsers',
                'assignProject' => function ($q) {
                    $q->select('project_name_id', 'employee_id');
                }
            ])
                ->withCount(['assignProject', 'projectPages'])
                ->get();
            $data['projects']
                ->each(function ($project) {
                    $project->assign_project_count_unique = $project->assignProject
                        ->groupBy('employee_id')
                        ->count();
                });
            return view('backend.pages.projects.index', $data);
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function projectCreatePage()
    {
        try {
            return view('backend.pages.projects.create-project');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'project_name' => 'required|string',
                'pages' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $validated = $validator->validated();
            $project = ProjectNames::create([
                'project_name' => $validated['project_name']
            ]);
            foreach ($validated['pages'] as $page) {
                $project->projectPages()->create([
                    'project_page' => $page
                ]);
            }
            return redirect()->route('project.index')->with('sucess', 'SuccessFully Created Project');
        } catch (\Throwable $th) {

            return $this->logError($th);
        }
    }
    public function projectAssignPage(Request $request)
    {
        try {
            $request->validate([
                'project_id' => 'required'
            ]);
            $data['project'] = ProjectNames::where('id', $request->project_id)->with(['projectPages' => function ($q) {
                $q->select('id', 'project_name_id', 'project_page');
            }])->first();
            $allUsers = User::with('userInfo.userPosition')->latest()->get();
            $data['users'] = $allUsers->reject(function ($user) {
                return $user->email === 'admin@gmail.com';
            });
            return view('backend.pages.projects.assign-project', $data);
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function projectAssignStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'project_name_id' => 'required|string',
                'page_id' => 'required',
                'users_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $validated = $validator->validated();
            foreach ($validated['users_id'] as $id) {
                foreach ($validated['page_id'] as $page_id) {
                    $user = AssignProjectToEmployee::where('employee_id', $id)->where('project_page_id', $page_id)->first();
                    if (!$user) {
                        AssignProjectToEmployee::create([
                            'employee_id' => $id,
                            'project_name_id' => $validated['project_name_id'],
                            'project_page_id' => $page_id
                        ]);
                        $staff_project_name_id_is = ProjectNamesAssignTostaff::where('employee_id', $id)->where('project_name_id', $validated['project_name_id'])->first();
                        if (!$staff_project_name_id_is) {
                            ProjectNamesAssignTostaff::create([
                                'employee_id' => $id,
                                'project_name_id' => $validated['project_name_id'],
                            ]);
                        }
                    }
                }
            }
            return redirect()->route('project.index')->with('success', 'Successfully Assign Project');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }

    public function singleProjectView($id)
    {
        try {
            $data['project'] = ProjectNames::where('id', $id)->with('projectPages.assignProject.assignProjectUSers')->first();
            return view('backend.pages.projects.view', $data);
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function projectEdit($id)
    {
        try {
            $data['project'] = ProjectNames::where('id', $id)->with('projectPages')->first();
            if ($data['project']) {
                return view('backend.pages.projects.project-edit', $data);
            }

            return redirect()->route('project.index')->with('error', 'Project Not Found');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function projectupdate(ProjectNames $project, Request $request)
    {
        try {
            $request->validate([
                'project_name' => 'required',
                'pages' => 'required',
            ]);

            if ($request->has('project_name')) {
                $project->update([
                    'project_name' => $request->project_name
                ]);
            }
            $projectPages = ProjectPages::where('project_name_id', $project->id)->get();
            foreach ($projectPages as $index => $projectPage) {
                $values = $request->pages[$index] ?? null;
                if ($values !== null) {
                    $projectPage->update([
                        'project_name_id' => $project->id,
                        'project_page' => $values
                    ]);
                }
            }

            if ($request->has('extra_pages')) {
                foreach ($request->extra_pages as $extra_page) {
                    if ($extra_page !== null) {
                        ProjectPages::create([
                            'project_name_id' => $project->id,
                            'project_page' => $extra_page
                        ]);
                    }
                }
            }
            // return;
            return redirect()->route('project.index')->with('success', 'SuccessFully Updated');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function assignStafftDelete($id)
    {
        try {
            $assingStaff = AssignProjectToEmployee::find($id);
            $assingStaffCount = AssignProjectToEmployee::where('project_name_id', $assingStaff->project_name_id)->where('employee_id', $assingStaff->employee_id)->count();
            if (!$assingStaff) {
                return back()->with('error', 'Not Found');
            }
            if ($assingStaffCount == 1) {
                ProjectNamesAssignTostaff::where('employee_id', $assingStaff->employee_id)->where('project_name_id', $assingStaff->project_name_id)->delete();
            }
            $assingStaff->delete();
            return back()->with('success', 'SuccessFully Assign Staff Deleted ');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function projectPageDelete($id)
    {
        try {
            $page = ProjectPages::find($id);
            if (!$page) {
                return back()->with('error', 'Not Found');
            }
            $page->delete();
            return back()->with('success', 'SuccessFully Deleted');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function projectDelete(ProjectNames $id)
    {
        try {
            if ($id) {
                $id->delete();
                return back()->with('success', 'SuccessFully Deleted');
            }
            return back()->with('error', 'Not Found');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
}
