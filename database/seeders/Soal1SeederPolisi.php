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
            'waktu_level1' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Insert multiple SoalLevel1 records with timestamps
        SoalLevel1::insert([
            [
                'role_name' => 'polisi',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 1 + 2 ?',
                'question_image' => null,
                'answer_a' => '3',
                'answer_b' => '4',
                'correct_answer' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_name' => 'polisi',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 2 - 3 ?',
                'question_image' => null,
                'answer_a' => '-2',
                'answer_b' => '-1',
                'correct_answer' => '-1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_name' => 'detektif',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 4 + 5 ?',
                'question_image' => null,
                'answer_a' => '9',
                'answer_b' => '10',
                'correct_answer' => '9',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_name' => 'detektif',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 6 - 7 ?',
                'question_image' => null,
                'answer_a' => '2',
                'answer_b' => '-1',
                'correct_answer' => '-1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_name' => 'nelayan',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 8 + 9 ?',
                'question_image' => null,
                'answer_a' => '17',
                'answer_b' => '18',
                'correct_answer' => '17',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_name' => 'nelayan',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 10 - 11 ?',
                'question_image' => null,
                'answer_a' => '3',
                'answer_b' => '-1',
                'correct_answer' => '-1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_name' => 'petani',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 12 + 13 ?',
                'question_image' => null,
                'answer_a' => '25',
                'answer_b' => '26',
                'correct_answer' => '25',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'role_name' => 'petani',
                'type_question' => 'math_question',
                'question_text' => 'Berapakah hasil dari 14 - 15 ?',
                'question_image' => null,
                'answer_a' => '4',
                'answer_b' => '-1',
                'correct_answer' => '-1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
