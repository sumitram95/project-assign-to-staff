<?php

namespace App\Http\Controllers\Backend\DashBoard\RoleAndPermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionontroller extends Controller
{
    public function roleIndexPage()
    {
        $data['roles'] = Role::with(['permissions'])->withCount('permissions')->get();

        return view('backend.pages.roleandpermisssion.roles', $data);
    }
    public function roleCreatePage()
    {
        $data['permissions'] = Permission::get();
        return view('backend.pages.roleandpermisssion.create-role', $data);
    }

    public function roleStorePage(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'role_name' => 'required',
            'permissions' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $roleExistCheck = Role::where('name', $validated['role_name'])->first();

        if ($roleExistCheck) {
            return back()->with('error', 'Sorry Already Exist ' . $validated['role_name'] . 'role try other name');
        }

        $role = Role::create([
            'name' => $validated['role_name']
        ]);
        //-- Give permissions to newly created role
        foreach ($validated['permissions'] as $permission) {
            $permissionCheckById = Permission::find($permission);
            if ($permissionCheckById) {
                $role->givePermissionTo($permissionCheckById);
            }
        }
        return redirect()->route('roles.index')->with('success', 'Succefully Role Created');
    }
    // -- Role edit page
    public function roleEditPermissionPage($id)
    {
        $data['roleWithPermissions'] = Role::with('permissions')->find($id);
        $data['roleWithPermissionsArray'] = $data['roleWithPermissions']->permissions->pluck('id')->toArray();
        if (!$data['roleWithPermissions']) {
            return back()->with('error', 'Not Found Role');
        }
        $data['permissions'] = Permission::get();
        return view('backend.pages.roleandpermisssion.edit-role', $data);
    }

    // -- update edit page data
    public function roleUpdatePermission(Request $request, $id)
    {
        $role = Role::find($id);

        $role->update([
            'name' => $request->role_name,
        ]);

        $intValues = array_map('intval', $request->permissions);
        $role->syncPermissions($intValues);

        return redirect()->route('roles.index')->with('success', 'Succefully Role Updated');
    }
    public function roleDelete($id)
    {
        $roleCheckById = Role::find($id);

        if (!$roleCheckById) {
            return back()->with('error', 'Not Found Role');
        }

        $roleCheckById->delete();
        return back()->with('success', 'SuccessFully Deleted');
    }

    public function permissionIndexPage()
    {
        $data['permissions'] = Permission::get();

        return view('backend.pages.roleandpermisssion.permissions', $data);
    }
}

