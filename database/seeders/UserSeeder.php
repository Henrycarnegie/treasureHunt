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
                'name' => 'murid',
                'username' => 'murid123',
                'password' => Hash::make('password')
        ]);
        $murid->assignRole('murid');
    }
}
