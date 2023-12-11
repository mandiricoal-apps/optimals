<?php

namespace Database\Seeders;

use App\Models\DailyInspectionSummary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/summary.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 100000, ";")) !== FALSE) {
            if (!$firstline) {
                DailyInspectionSummary::create([
                    "id" => $data['0'],
                    "inspection_id" => $data['1'],
                    "question_id" => $data['2'],
                    "answer_id" => $data['3'],
                    "score" => $data['4'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
