<?php

namespace Database\Seeders;

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

        $murid = User::create([
                'name' => 'polisi',
                'username' => 'polisi123',
                'password' => Hash::make('password')
        ]);
        $murid->assignRole('polisi');

        $murid = User::create([
                'name' => 'detektif',
                'username' => 'detektif123',
                'password' => Hash::make('password')
        ]);
        $murid->assignRole('detektif');

        $murid = User::create([
                'name' => 'nelayan',
                'username' => 'nelayan123',
                'password' => Hash::make('password')
        ]);
        $murid->assignRole('nelayan');

        $murid = User::create([
                'name' => 'petani',
                'username' => 'petani123',
                'password' => Hash::make('password')
        ]);
        $murid->assignRole('petani');
    }
}
