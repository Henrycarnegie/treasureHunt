<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalLevel2 extends Model
{
    protected $table = 'soal_level2';

    protected $fillable = [
        'question_text',
        'question_image',
        'answer_a',
        'answer_b',
        'answer_c',
        'answer_d',
        'correct_answer',
    ];
}
