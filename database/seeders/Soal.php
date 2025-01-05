<?php

namespace Database\Seeders;

use App\Models\Level1;
use App\Models\Level2;
use App\Models\Level3;
use App\Models\Level4;
use App\Models\Level5;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Soal extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level1::create([
            'waktu_level1' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Level2::create([
            'waktu_level2' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Level3::create([
            'waktu_level3' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Level4::create([
            'waktu_level4' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Level5::create([
            'nyawa' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
