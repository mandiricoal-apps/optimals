<?php

namespace Database\Seeders;

use App\Models\DataLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/location.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 5000, ";")) !== FALSE) {
            if (!$firstline) {
                DataLocation::create([
                    "id" => $data['0'],
                    "inspection_id" => $data['1'],
                    "pit" => $data['2'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
