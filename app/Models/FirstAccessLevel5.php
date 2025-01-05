<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstAccessLevel5 extends Model
{
    protected $table = 'first_access_level5';

    protected $fillable = [
        'role_name',
        'nyawa',
        'status',
    ];
}
