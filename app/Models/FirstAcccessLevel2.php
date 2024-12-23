<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstAcccessLevel2 extends Model
{
    protected $table = 'first_acccess_level2';

    protected $fillable = [
        'role_name',
        'end_time',
    ];
}
