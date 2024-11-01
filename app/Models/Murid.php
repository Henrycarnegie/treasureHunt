<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    protected $table = 'murid';

    protected $fillable = [
        'users_id',
        'score_level_1',
        'score_level_2',
        'score_level_3',
        'score_level_4',
        'score_level_5',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function answerLevel1()
    {
        return $this->hasMany(AnswerLevel1::class, 'murid_id');
    }

}
