<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authcontroller;
use App\Http\Controllers\InactiveController;
use App\Http\Controllers\Backend\DashBoard\DashBoardController;
use App\Http\Controllers\Backend\DashBoard\ProfileController;
use App\Http\Controllers\Backend\DashBoard\EmployeeController;
use App\Http\Controllers\Backend\DashBoard\ProjectController;
use App\Http\Controllers\Backend\DashBoard\StaffPersonalTaskController;
use App\Http\Controllers\Backend\DashBoard\RoleAndPermission\RoleAndPermissionontroller;
use App\Http\Controllers\ErrorsInWebsite\ErrorShowControlle;
use App\Http\Controllers\EmailVerifyController;

;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// ********************   Test Form data check ****************************************/
// Route::post("/", [Testcontroller::class, "testFormData"])->name("testform");
Route::get('data-changer', function () {
    return view('backend.pages.test.test');
});

Route::post('/date-changer', [ErrorShowControlle::class, 'dateChanger'])->name('date.changer');

// only guest access this page (authenticated user not)
Route::middleware(['guest'])->group(function () {

    // ********************   Auth controller ****************************************/
    Route::get("/login", [Authcontroller::class, 'loginPage'])->name('login');
    Route::post("/login-check", [Authcontroller::class, 'loggedIn'])->name('login.check');

    // user device infomation getting function
    Route::get("/getuserinfo", [Authcontroller::class, 'getUserDetails']);
});

// ************email verify**********************/
Route::get('/email/verify/{crypt_id}', [EmailVerifyController::class, 'emailVerified'])->name('email.verify');
Route::get('/email/unverified', [EmailVerifyController::class, 'emailunVerifiedpage'])->middleware('auth')->name('email.unverified');
Route::post('/email/resend-email-verification/{id}', [EmailVerifyController::class, 'againEmailVerify'])->middleware('auth')->name('email.again.verified');

// only authenticated user access this page not guest
Route::middleware(['auth', 'isemailverfied'])->group(function () {

    Route::get('/inactive', [InactiveController::class, 'inactive'])->name('inactive');

    Route::get('/dashboard', [DashBoardController::class, 'dashBoardViewPage'])->name('dashboard.index')->middleware(['permission:staff management|projects management|project assign management|role and permission management|staff view own tasks', 'isactive']);
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });
    // -- only role admin open this all controller
    Route::middleware(['permission:staff management|projects management|project assign management|role and permission management', 'isactive'])->group(function () {

        // ************* EmployeeController ***************************/
        Route::group(['prefix' => 'employee'], function () {
            Route::get('/lists', [EmployeeController::class, 'employeeIndex'])->name('employee.index');
            Route::get('/create', [EmployeeController::class, 'employeeCreatePage'])->name('employee.create');

            Route::post('/store', [EmployeeController::class, 'employeeStore'])->name('employee.store');

            Route::get('/edit/{id}', [EmployeeController::class, 'employeEditPage'])->name('employee.edit');
            Route::put('/update/{employee_id}', [EmployeeController::class, 'employeUpdate'])->name('employee.update');

            Route::get('/delete/{uid}', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete');

        });
        // ************* End EmployeeController ***************************/

        // ************* ProjectController ***************************/
        Route::group(['prefix' => 'project'], function () {
            Route::get('/lists', [ProjectController::class, 'projectIndexPage'])->name('project.index');
            Route::get('/create-project', [ProjectController::class, 'projectCreatePage'])->name('create.project');
            Route::post('/create-project-store', [ProjectController::class, 'store'])->name('create.project.store');

            Route::post('/assign-project', [ProjectController::class, 'projectAssignPage'])->name('assign.project.index');
            Route::post('/assign-project-store', [ProjectController::class, 'projectAssignStore'])->name('assign.project.store');
            Route::post('/fetch-pages', [ProjectController::class, 'fetchPages'])->name('fetch.pages');

            Route::get('/view/{id}/{name}', [ProjectController::class, 'singleProjectView'])->name('project.view');

            Route::get('/project-edit/{id}', [ProjectController::class, 'projectEdit'])->name('project.edit');
            Route::post('/project-update/{project}', [ProjectController::class, 'projectupdate'])->name('project.update');
            // Route::get('/projec-add-extra-page/{project}', [ProjectController::class, 'projectInsideAddExtraPage'])->name('project.add.extra.page');
            // Route::post('/projec-add-extra-page-store/{project}', [ProjectController::class, 'projectInsideAddExtraPageStore'])->name('project.add.extra.page.store');
            Route::get('/assign-staff-delete/{id}', [ProjectController::class, 'assignStafftDelete'])->name('assign.staff.delete');
            Route::get('/delete-page/{id}', [ProjectController::class, 'projectPageDelete'])->name('project.page.delete');
            Route::get('/project-delete/{id}', [ProjectController::class, 'projectDelete'])->name('project.delete');
        });
        // ************* End ProjectController ***************************/

        // ************* ProfileController ***************************/
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/admin/view/{id}/staff', [ProfileController::class, 'staffSingleViewPage'])->name('staff.profile.view');
        });
        // ************* End ProfileController ***************************/

        // ************* RoleAndPermissionController ***************************/
        Route::group(['prefix' => 'role-and-permission'], function () {
            Route::get('/roles', [RoleAndPermissionontroller::class, 'roleIndexPage'])->name('roles.index');
            Route::get('/create-role', [RoleAndPermissionontroller::class, 'roleCreatePage'])->name('role.create.page');
            Route::post('/store-role', [RoleAndPermissionontroller::class, 'roleStorePage'])->name('role.store');

            Route::get('/edit-role/{id}', [RoleAndPermissionontroller::class, 'roleEditPermissionPage'])->name('role_permission.edit.page');
            Route::put('/update-role/{id}', [RoleAndPermissionontroller::class, 'roleUpdatePermission'])->name('role_permission.updatae_data_store');

            Route::get('/delete-role/{id}', [RoleAndPermissionontroller::class, 'roleDelete'])->name('role.delete');

            Route::get('/permissions', [RoleAndPermissionontroller::class, 'permissionIndexPage'])->name('permissions.index');
        });
        // *************end  RoleAndPermissionController ***************************/

    });
    // -- end only role admin open this all controller


    // ************* StaffPersonalTaskController ***************************/
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/index', [StaffPersonalTaskController::class, 'staffTask'])->name('staff.task.index')->middleware(['isactive']);
        Route::post('/staff-group/{id}', [StaffPersonalTaskController::class, 'staffGroup'])->name('project.group.staff.name')->middleware(['isactive']);
    });
    // ************* End StaffPersonalTaskController ***************************/


    // ************* ProfileController ***************************/
    Route::group(['prefix' => 'profile'], function () {

        Route::get('profile', [ProfileController::class, 'profileIndex'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'profileEditPage'])->name('profile.edit.page');
        Route::put('/store', [ProfileController::class, 'profileEditPageDataStore'])->name('profile.edit.page.data.store');

        // password change page
        Route::get('/password-change', [ProfileController::class, 'passwordChangePage'])->name('password.change.page');
        // passwordChangeStore
        Route::post('/password-change', [ProfileController::class, 'passwordChangeStore'])->name('password.change.store');
    });
    // ************* End ProfileController ***************************/

    Route::get("/logout", [Authcontroller::class, 'logOut'])->name('log.out');
    Route::get('/errors', [ErrorShowControlle::class, 'errorIndex'])->name('errors.website.index');
    Route::get('/error-in-code/{id}', [ErrorShowControlle::class, 'errorViewCode'])->name('errors.website.view.code');
});

Route::get('/welcome-email', function () {
    return view('emails.welcome');
});
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');


// use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect()->route('dashboard.index');
// })->middleware(['auth'])->name('verification.verify');


// use Illuminate\Http\Request;

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
