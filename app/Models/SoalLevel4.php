<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalLevel4 extends Model
{
    protected $table = 'soal_level4';

    protected $fillable = [
        'type',
        'question_text',
        'question_image',
    ];

    public function answer()
    {
        return $this->hasMany(AnswerLevel4::class, 'soal_level4_id', 'id');
    }
}
