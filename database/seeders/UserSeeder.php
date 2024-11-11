<?php

namespace Database\Seeders;

use App\Models\Murid;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guru = User::create([
                'name' => 'guru',
                'username' => 'guru123',
                'password' => Hash::make('password')
        ]);
        $guru->assignRole('guru');

        $userMurid = User::create([
                'name' => 'polisi',
                'username' => 'polisi123',
                'password' => Hash::make('password')
        ]);
        $userMurid->assignRole('polisi');

        Murid::create([
            'users_id' => $userMurid->id,
            'score_level_1' => 0,
            'score_level_2' => 0,
            'score_level_3' => 0,
            'score_level_4' => 0,
            'score_level_5' => 0
        ]);

        $userMurid = User::create([
                'name' => 'detektif',
                'username' => 'detektif123',
                'password' => Hash::make('password')
        ]);
        $userMurid->assignRole('detektif');

        $murid = Murid::create([
            'users_id' => $userMurid->id,
            'score_level_1' => 0,
            'score_level_2' => 0,
            'score_level_3' => 0,
            'score_level_4' => 0,
            'score_level_5' => 0
        ]);

        $userMurid = User::create([
                'name' => 'nelayan',
                'username' => 'nelayan123',
                'password' => Hash::make('password')
        ]);
        $userMurid->assignRole('nelayan');

        $murid = Murid::create([
            'users_id' => $userMurid->id,
            'score_level_1' => 0,
            'score_level_2' => 0,
            'score_level_3' => 0,
            'score_level_4' => 0,
            'score_level_5' => 0
        ]);

        $userMurid = User::create([
                'name' => 'petani',
                'username' => 'petani123',
                'password' => Hash::make('password')
        ]);
        $userMurid->assignRole('petani');

        $murid = Murid::create([
            'users_id' => $userMurid->id,
            'score_level_1' => 0,
            'score_level_2' => 0,
            'score_level_3' => 0,
            'score_level_4' => 0,
            'score_level_5' => 0
        ]);
    }
}
