<?php
namespace App\Http\Controllers\Backend\DashBoard;

use App\Constant\Status;
use App\Http\Controllers\BaseController\ErrorLogController;
use App\Mail\WelcomeEmail;
use App\Models\Position;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class EmployeeController extends ErrorLogController
{
    public function employeeIndex()
    {
        try {
            $data['allUsers'] = User::with('userInfo.userPosition')->get();
            $data['users'] = $data['allUsers']->reject(function ($user) {
                return $user->email === 'admin@gmail.com';
            });
            return view('backend.pages.employees.employee', $data);
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function employeeCreatePage()
    {
        try {
            $data['roles'] = Role::get();
            $data['positions'] = Position::get();
            return view('backend.pages.employees.create-employee', $data);
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function employeeStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'position' => 'required|numeric',
                'role' => 'required',
                'status' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $validated = $validator->validated();
            $uid = rand(10000, 59999);
            do {
                $uid = rand(10000, 59999);
            } while (User::where('uid', $uid)->exists());
            $position = Position::find($validated['position']);
            $data['role'] = Role::where('name', $validated['role'])->first();
            if (!$data['role']) {
                return back()->with('error', 'Wrong Role filed');
            }
            if (!$position) {
                return back()->with('error', 'Wrong Position filed');
            }
            if ((!in_array($validated['status'], [Status::ACTIVE, Status::INACTIVE]))) {
                session()->put(['error' => 'Please select valid status']);
                return back();
            }
            $user = User::create([
                'uid' => $uid,
                'email' => $validated['email'],
                'password' => Hash::make('password'),
            ]);
            $user->userInfo()->create([
                'full_name' => $validated['full_name'],
                'position_id' => $validated['position'],
                'status' => $validated['status']
            ]);
            $user->assignRole($validated['role']);
            // Mail::to($validated['email'])->send(new WelcomeEmail($user->id, $validated['full_name'], $position->position, $validated['status'], $user->getRoleNames()->first()));
            return redirect()->route('employee.index')->with('success', 'SuccessFully Saved');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function employeEditPage($id)
    {
        try {
            $data['user'] = UserInfo::with('user', 'userPosition')->where('employee_id', $id)->first();
            if (!$data['user']) {
                return redirect()->route('employee.index')->with(['error' => 'Not Found Employee ID']);
            }
            $data['roles'] = Role::get();
            $data['positions'] = Position::get();
            return view('backend.pages.employees.edit-employee', $data)->with('success', 'Succefully Created');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }

    public function employeUpdate($employee_id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'position' => 'required',
                'role' => 'required',
                'status' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $validated = $validator->validated();
            $userInfo = UserInfo::with('user')->where('employee_id', $employee_id)->first();
            if (!$userInfo) {
                return redirect()->route('employee.index')->with(['error' => 'Not Found Employee ID']);
            }
            $userInfo->user->syncRoles($validated['role']);
            $userInfo->full_name = $validated['full_name'];
            $userInfo->position_id = $validated['position'];
            if ((!in_array($validated['status'], [Status::ACTIVE, Status::INACTIVE]))) {
                session()->put(['error' => 'Please select valid status']);
                return back();
            }
            $userInfo->status = $validated['status'];
            $userInfo->save();
            return redirect()->route('employee.index')->with('success', 'Updated SuccessFully');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }

    public function deleteEmployee($uid)
    {
        try {
            $user = User::with('userInfo')->where('uid', $uid);
            if (!$user) {
                return redirect()->route('employee.index')->with('error', 'Not Found Employee ID');
            }
            $user->first()->userInfo->delete();
            $user->delete();
            return redirect()->route('employee.index')->with('success', 'SuccessFully Deleted');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
}
