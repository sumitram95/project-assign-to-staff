<?php
namespace App\Http\Controllers\Backend\DashBoard;

use App\Http\Controllers\BaseController\ErrorLogController;
use App\Models\ProjectNames;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends ErrorLogController
{
    // In a controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashBoardViewPage()
    {
        try {
            return view('backend.pages.dashboard', $this->data(['user_count', 'project_count', 'authUserProject']));
        } catch (\Throwable $th) {
            return $this->logError($th);
        }
    }

    public function data($values)
    {
        $data = [];
        foreach ($values as $value) {
            switch ($value) {
                case 'user_count':
                    $data['user_count'] = User::count();
                    break;
                case 'project_count':
                    $data['project_count'] = ProjectNames::count();
                    break;
                case 'authUserProject':
                    $data['userProject'] = User::where('id', Auth::id())->with(['projectNamesPivot.projectNames.onlyAuthStaffPivot.getPages'])->first();
            }
        }
        return $data;
    }
}

