<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerLevel2 extends Model
{
    protected $table = 'answer_level2';

    protected $fillable = [
        'murid_id',
        'soal_level2_id',
        'answer',
        'is_correct',
        'image_reason',
        'point_answer',
        'point_reason',
        'total_point',
    ];

    public function soalLevel2()
    {
        return $this->belongsTo(SoalLevel2::class, 'soal_level2_id');
    }
}
