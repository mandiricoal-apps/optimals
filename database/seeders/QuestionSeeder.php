<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/questions.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                Question::create([
                    "question" => $data['0'],
                    "weight" => $data['1'],
                    "area_id" => $data['2'],
                    "numbering" => $data['3'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);

        $csvFile = fopen(base_path("database/data/answers.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                Answer::create([
                    "answer" => $data['0'],
                    "question_id" => $data['1'],
                    "point" => $data['2'],
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
