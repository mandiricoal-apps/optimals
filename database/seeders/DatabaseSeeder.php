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
        $user->assignRole($role);
    }
}
