<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'guru', 'guard_name' => 'web']);
        Role::create(['name' => 'polisi', 'guard_name' => 'web']);
        Role::create(['name' => 'detektif', 'guard_name' => 'web']);
        Role::create(['name' => 'nelayan', 'guard_name' => 'web']);
        Role::create(['name' => 'petani', 'guard_name' => 'web']);
    }
}
