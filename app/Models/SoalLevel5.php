<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalLevel5 extends Model
{
    protected $table = 'soal_level5';

    protected $fillable = [
        'question_text',
        'question_image',
        'answer_a',
        'answer_b',
        'answer_c',
        'answer_d',
        'correct_answer',
    ];

    public function answer()
    {
        return $this->hasMany(AnswerLevel5::class, 'soal_level5_id', 'id');
    }
}
