<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level1 extends Model
{
    protected $table = 'level1';

    protected $fillable = [
        'waktu_level1',
        'text',
    ];
}
