<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstAcccessLevel1 extends Model
{
    protected $table = 'first_acccess_level1';

    protected $fillable = [
        'role_name',
        'end_time',
        'status',
    ];
}
