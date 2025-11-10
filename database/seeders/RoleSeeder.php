<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

use Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $super_admin =  Role::create([
            'role_reference' =>  Str::uuid(),
            'name' => 'super admin',
            'guard_name' => 'web',
        ]);

        $director =  Role::create([
            'role_reference' =>  Str::uuid(),
            'name' => 'director',
            'guard_name' => 'web',
        ]);

        $admin =  Role::create([
            'role_reference' =>  Str::uuid(),
            'name' => 'administrator',
            'guard_name' => 'web',
        ]);

        $supervisor =  Role::create([
            'role_reference' =>  Str::uuid(),
            'name' => 'supervisor',
            'guard_name' => 'web',
        ]);

        $cashier =  Role::create([
            'role_reference' =>  Str::uuid(),
            'name' => 'cashier',
            'guard_name' => 'web',
        ]);

        $operator =  Role::create([
            'role_reference' =>  Str::uuid(),
            'name' => 'operator',
            'guard_name' => 'web',
        ]);


        $permissions = Permission::select('id', 'permission_reference', 'guard_name')->get()->keyBy('id');

        $super_admin->syncPermissions($permissions);
        $director->syncPermissions($permissions);
        $admin->syncPermissions($permissions);

    }


}
