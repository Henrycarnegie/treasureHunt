<?php

namespace Database\Seeders;

use App\Models\BoxLevel3;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class boxLevel3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BoxLevel3::insert([
            [
                'nama_box' => 'Box 1',
            ],
            [
                'nama_box' => 'Box 2',
            ],
            [
                'nama_box' => 'Box 3',
            ],
            [
                'nama_box' => 'Box 4',
            ],
        ]);
    }
}
