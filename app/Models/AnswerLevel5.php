<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerLevel5 extends Model
{
    protected $table = 'answer_level5';

    protected $fillable = [
        'murid_id',
        'soal_level5_id',
        'answer',
        'is_correct',
        'point_answer',
        'total_point',
    ];
}
