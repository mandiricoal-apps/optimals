<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $role = Role::create(['name' => 'admin', 'description' => 'Administrator']);
        Role::create(['name' => 'operation', 'description' => 'Operation']);
        Role::create(['name' => 'Reviewer MIP', 'description' => 'Reviewer MIP']);
        Role::create(['name' => 'Reviewer MKP', 'description' => 'Reviewer MKP']);

        Permission::create(['name' => 'view_user', 'parent' => '[MD] User', 'type' => 'view']);
        Permission::create(['name' => 'edit_user', 'parent' => '[MD] User', 'type' => 'edit']);
        Permission::create(['name' => 'create_user', 'parent' => '[MD] User', 'type' => 'create']);
        Permission::create(['name' => 'delete_user', 'parent' => '[MD] User', 'type' => 'delete']);

        Permission::create(['name' => 'view_roles', 'parent' => '[MD] Roles', 'type' => 'view']);
        Permission::create(['name' => 'edit_roles', 'parent' => '[MD] Roles', 'type' => 'edit']);
        Permission::create(['name' => 'create_roles', 'parent' => '[MD] Roles', 'type' => 'create']);

        Permission::create(['name' => 'view_area', 'parent' => '[MD] Area', 'type' => 'view']);
        Permission::create(['name' => 'edit_area', 'parent' => '[MD] Area', 'type' => 'edit']);
        Permission::create(['name' => 'create_area', 'parent' => '[MD] Area', 'type' => 'create']);
        Permission::create(['name' => 'delete_area', 'parent' => '[MD] Area', 'type' => 'delete']);




        $user = new User();
        $user->name = 'Super Admin';
        // $user->user_id = 'MIP-0001';
        $user->company = 'MIP';
        $user->nik = '0001';
        $user->division = 'IT';
        // $user->email = 'admin@mail.com';
        // $user->email_verified_at = date('Y:m:d H:i:s');
        $user->password = Hash::make('123123');
        $user->save();

        $role->givePermissionTo('view_user');
        $role->givePermissionTo('edit_user');
        $role->givePermissionTo('create_user');
        $role->givePermissionTo('delete_user');

        $role->givePermissionTo('view_roles');
        $role->givePermissionTo('edit_roles');
        $role->givePermissionTo('create_roles');

        $role->givePermissionTo('view_area');
        $role->givePermissionTo('edit_area');
        $role->givePermissionTo('create_area');
        $role->givePermissionTo('delete_area');

        $user->assignRole($role);
    }
}
