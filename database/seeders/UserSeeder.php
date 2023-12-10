<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/users.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                User::create([
                    "id" => $data['0'],
                    "name" => $data['1'],
                    "user_id" => $data['2'],
                    "nik" => $data['3'],
                    "company" => $data['4'],
                    "division" => $data['5'],
                    "first_time" => $data['6'],
                    "email" => $data['7'],
                    "password" => $data['8'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);

        $csvFile = fopen(base_path("database/data/model_has_roles.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                $user = User::find($data['2']);
                $role = Role::find($data['0']);
                $user->assignRole($role);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
