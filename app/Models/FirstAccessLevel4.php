<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstAccessLevel4 extends Model
{
    protected $table = 'first_access_level4';

    protected $fillable = [
        'role_name',
        'end_time',
        'status',
    ];
}
