<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxLevel3 extends Model
{
    protected $table = 'box_level3';

    protected $fillable = [
        'nama_box',
    ];

    public function soalLevel3()
    {
        return $this->hasMany(SoalLevel3::class, 'box_id', 'id');
    }
}
