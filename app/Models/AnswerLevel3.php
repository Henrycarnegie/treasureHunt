<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerLevel3 extends Model
{
    protected $table = 'answer_level3';

    protected $fillable = [
        'murid_id',
        'soal_level3_id',
        'image_reason',
        'point_reason',
        'total_point',
    ];
}
