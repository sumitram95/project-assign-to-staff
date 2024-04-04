<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = ['admin', 'employee'];

        $permissions = [
            'staff management',
            'projects management',
            'project assign management',
            'role and permission management',
            'profile management',
            'staff view own tasks'
        ];


        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //-- For admin Role & permissions

        $givePermissionToEmployee = Role::where('name', 'admin')->first();
        $givePermissionToEmployee->givePermissionTo([
            'staff management',
            'projects management',
            'project assign management',
            'role and permission management',
            'profile management',
        ]);

        //-- For employee Role & permissions

        $givePermissionToEmployee = Role::where('name', 'employee')->first();
        $givePermissionToEmployee->givePermissionTo([
            'profile management',
            'staff view own tasks',
        ]);
    }
}
