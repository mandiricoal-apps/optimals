<?php

namespace Database\Seeders;

use App\Models\DailyInspection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/inspection.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 5000, ";")) !== FALSE) {
            if (!$firstline) {
                DailyInspection::create([
                    "id" => $data['0'],
                    "create_by" => $data['1'],
                    "area_id" => $data['2'],
                    "total_score" => $data['3'],
                    "created_at" => $data['4'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
