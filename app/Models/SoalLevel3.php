<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalLevel3 extends Model
{
    protected $table = 'soal_level3';

    protected $fillable = [
        'box_id',
        'question_text',
        'question_image',
    ];
}
