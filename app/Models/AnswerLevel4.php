<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerLevel4 extends Model
{
    protected $table = 'answer_level4';

    protected $fillable = [
        'murid_id',
        'soal_level4_id',
        'image_reason',
        'point_reason',
        'total_point',
    ];

    public function soalLevel4()
    {
        return $this->belongsTo(SoalLevel4::class, 'soal_level4_id');
    }
}
