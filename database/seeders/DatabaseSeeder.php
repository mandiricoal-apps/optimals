<?php

namespace Database\Seeders;

use App\Models\Area;
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

        $role = Role::create(['name' => 'admin', 'description' => 'Administrator', 'accesbility_data' => 'all', 'is_admin' => 1]);
        Role::create(['name' => 'Reviewer MIP', 'description' => 'Reviewer MIP', 'accesbility_data' => 'all', 'is_admin' => 0]);
        Role::create(['name' => 'Reviewer MKP', 'description' => 'Reviewer MKP', 'accesbility_data' => 'user_company', 'is_admin' => 0]);
        Role::create(['name' => 'Reviewer RML', 'description' => 'Reviewer RML', 'accesbility_data' => 'user_company', 'is_admin' => 0]);
        Role::create(['name' => 'Operational Team', 'description' => 'Operational Team', 'accesbility_data' => 'all', 'is_admin' => 0]);
        Role::create(['name' => 'Admin Operational', 'description' => 'Admin Operational', 'accesbility_data' => 'all', 'is_admin' => 1]);


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

        Permission::create(['name' => 'view_qna', 'parent' => '[MD] Question and Answer', 'type' => 'view']);
        Permission::create(['name' => 'edit_qna', 'parent' => '[MD] Question and Answer', 'type' => 'edit']);
        Permission::create(['name' => 'create_qna', 'parent' => '[MD] Question and Answer', 'type' => 'create']);
        Permission::create(['name' => 'delete_qna', 'parent' => '[MD] Question and Answer', 'type' => 'delete']);

        Permission::create(['name' => 'view_daily_inspection', 'parent' => '[Trans] Daily Inspection', 'type' => 'view']);
        Permission::create(['name' => 'edit_daily_inspection', 'parent' => '[Trans] Daily Inspection', 'type' => 'edit']);
        Permission::create(['name' => 'delete_daily_inspection', 'parent' => '[Trans] Daily Inspection', 'type' => 'delete']);

        Permission::create(['name' => 'view_issue', 'parent' => '[Trans] Issue', 'type' => 'view']);
        Permission::create(['name' => 'edit_issue', 'parent' => '[Trans] Issue', 'type' => 'edit']);
        Permission::create(['name' => 'delete_issue', 'parent' => '[Trans] Issue', 'type' => 'delete']);

        Permission::create(['name' => 'progress_issue', 'parent' => '[Trans] Issue - On Progress', 'type' => 'view']);
        Permission::create(['name' => 'close_issue', 'parent' => '[Trans] Issue - Closed', 'type' => 'view']);
        Permission::create(['name' => 'cancle_issue', 'parent' => '[Trans] Issue - Cancel', 'type' => 'view']);



        $user = new User();
        $user->name = 'Super Admin';
        $user->user_id = 'IT-MIP';
        $user->company = 'MIP';
        $user->nik = '0000';
        $user->division = 'IT';
        $user->email = 'hiski46@gmail.com';
        // $user->email_verified_at = date('Y:m:d H:i:s');
        $user->password = Hash::make(md5('hirika'));
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

        $role->givePermissionTo('view_qna');
        $role->givePermissionTo('edit_qna');
        $role->givePermissionTo('create_qna');
        $role->givePermissionTo('delete_qna');

        $role->givePermissionTo('view_daily_inspection');
        $role->givePermissionTo('edit_daily_inspection');
        $role->givePermissionTo('delete_daily_inspection');

        $role->givePermissionTo('view_issue');
        $role->givePermissionTo('edit_issue');
        $role->givePermissionTo('delete_issue');

        $role->givePermissionTo('progress_issue');
        $role->givePermissionTo('close_issue');
        $role->givePermissionTo('cancle_issue');


        $user->assignRole($role);

        Area::create(['area_name' => 'Front Loading OB', 'description' => 'Front Loading OB']);
        Area::create(['area_name' => 'Front Loading Coal', 'description' => 'Front Loading Coal']);
        Area::create(['area_name' => 'Dewatering', 'description' => 'Dewatering']);
        Area::create(['area_name' => 'Disposal', 'description' => 'Disposal']);
        Area::create(['area_name' => 'Haulroad', 'description' => 'Haulroad']);

        $this->call([
            UserSeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
