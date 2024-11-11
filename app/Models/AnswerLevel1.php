<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerLevel1 extends Model
{
    protected $table = 'answer_level1';

    protected $fillable = [
        'murid_id',
        'soal_level1_id',
        'answer',
        'is_correct',
        'image_reason',
        'point_answer',
        'point_reason',
        'total_point',
    ];

    public function murid()
    {
        return $this->belongsTo(Murid::class, 'murid_id');
    }

    public function soalLevel1()
    {
        return $this->belongsTo(SoalLevel1::class, 'soal_level1_id');
    }
}
