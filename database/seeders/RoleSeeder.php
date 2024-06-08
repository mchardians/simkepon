<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()->insert([
            ['name' => 'admin', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'bendahara', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'walisantri', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'kepalapondok', 'created_at' => now(), 'updated_at' => now(),],
        ]);
    }
}
