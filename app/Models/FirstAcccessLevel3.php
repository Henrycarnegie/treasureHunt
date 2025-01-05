<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstAcccessLevel3 extends Model
{
    protected $table = 'first_acccess_level3';

    protected $fillable = [
        'box_id',
        'role_name',
        'end_time',
        'status',
    ];
}
