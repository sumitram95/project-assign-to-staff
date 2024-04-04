<?php

namespace App\Http\Controllers\Backend\DashBoard;


use App\Http\Controllers\BaseController\ErrorLogController;
use App\Models\ErrorsInWebsite;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends ErrorLogController
{
    public function profileIndex()
    {
        try {
            return view('backend.pages.profiles.staff-profile', $this->allData(Auth::id(), 'first'));
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function profileEditPage()
    {
        try {
            $data['user'] = User::with('userInfo')->find(Auth::id());
            return view('backend.pages.profiles.profile-edit', $data);
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function profileEditPageDataStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'profile_img' => 'sometimes|required|image|mimes:png,jpg',
                'full_name' => 'required',
                'mobile_no' => 'required|numeric',
                'about_me' => 'required',
                'date_of_birth' => 'required',
                'skills' => 'required',
                'admission_date' => 'required',
                'collage_name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $validated = $validator->validated();
            $profile_img = auth()->user()->userInfo->profile_img;
            if ($request->has('profile_img')) {
                $profile_img = now()->timestamp . '.' . $request->file('profile_img')->getClientOriginalExtension();
                $request->file('profile_img')->storeAs('/profile', $profile_img, 'public_upload');
            }
            $userInfo = UserInfo::where('employee_id', auth()->user()->uid);
            $user_mobile_unique = UserInfo::where('mobile_no', $request->mobile_no)->first();
            $mobile_no = $request->mobile_no;
            $extra = $user_mobile_unique ? 'Already Exist this mobile number' : '';
            if ($user_mobile_unique) {
                $mobile_no = $userInfo->first()->mobile_no;
            }
            $userInfo->update([
                'profile_img' => $profile_img,
                'full_name' => $validated['full_name'],
                'mobile_no' => $mobile_no,
                'about_me' => $validated['about_me'],
                'date_of_birth' => $validated['date_of_birth'],
                'skills' => $validated['skills'],
                'admission_date' => $validated['admission_date'],
                'collage_name' => $validated['collage_name']
            ]);
            return back()->with(['success' => 'Profile SuccessFully Updated', 'extra' => $extra]);
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }

    public function staffSingleViewPage($id)
    {
        try {
            return view('backend.pages.profiles.admin-staff-single-view-page', $this->allData($id, 'first'));
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function allData($id, $method = 'first')
    {
        try {
            $data['user'] = User::with('userInfo.userPosition')->where('id', '=', $id)->$method();
            $data['skills'] = $data['user'] ? explode(',', $data['user']->userInfo->skills) : [''];
            return $data;
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function passwordChangePage()
    {
        try {
            return view('backend.pages.profiles.password-change');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
    public function passwordChangeStore(Request $request)
    {
        try {
            $data['validator'] = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required',
                'comfirm_password' => 'required|same:new_password'
            ]);
            if ($data['validator']->fails()) {
                return back()->withErrors($data['validator'])->withInput();
            }
            $data['validated'] = $data['validator']->validated();
            $user = Auth::user();
            if (!Hash::check($data['validated']['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.'])->with(['error' => 'The password is incorrect']);
            }
            $user->update([
                'password' => Hash::make($request->comfirm_password),
            ]);
            return redirect()->route('dashboard.index')->with("success", 'SuccessFully Password Updated');
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }
}
