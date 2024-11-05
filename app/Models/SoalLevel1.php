<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class SoalLevel1 extends Model
{
    protected $table = 'soal_level1';

    protected $fillable = [
        'role_name',
        'type_question',
        'question_text',
        'question_image',
        'answer_a',
        'answer_b',
        'correct_answer',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_name', 'name');
    }

    public function answerLevel1()
    {
        return $this->hasMany(AnswerLevel1::class, 'level_1_id');
    }
}
