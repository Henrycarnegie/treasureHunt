<?php

namespace Database\Seeders;

use App\Models\Level1;
use App\Models\SoalLevel1;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Soal1SeederPolisi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the Level1 record with timestamps
        Level1::create([
            'waktu_level1' => 15,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Insert multiple SoalLevel1 records with timestamps
        SoalLevel1::insert([
            [
                'role_name' => 'polisi',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 5 + 3 ?',
                'question_image' => null,
                'answer_a' => '7',
                'answer_b' => '8',
                'correct_answer' => '8',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_name' => 'polisi',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 9 - 4 ?',
                'question_image' => null,
                'answer_a' => '5',
                'answer_b' => '6',
                'correct_answer' => '5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
