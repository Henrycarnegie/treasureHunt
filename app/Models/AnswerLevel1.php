<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerLevel1 extends Model
{
    protected $table = 'level_1';

    protected $fillable = [
        'murid_id',
        'level_1_id',
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

    public function level1()
    {
        return $this->belongsTo(SoalLevel1::class, 'level_1_id');
    }
}
