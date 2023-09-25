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
        $role = Role::create(['name' => 'admin']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'delete user']);

        $this->call([CompaniesSeeder::class]);

        $user = new User();
        $user->name = 'Super Admin';
        $user->user_id = 'MIP-0001';
        $user->company_id = 1;
        $user->nik = '0001';
        $user->position = 1;
        $user->division = 1;
        $user->email = 'admin@mail.com';
        $user->email_verified_at = date('Y:m:d H:i:s');
        $user->password = Hash::make('123123');
        $user->save();

        $role->givePermissionTo('view user');
        $role->givePermissionTo('edit user');
        $role->givePermissionTo('create user');
        $role->givePermissionTo('delete user');
        $user->assignRole($role);
    }
}
