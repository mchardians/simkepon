<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@simkepon.app',
                'password' => bcrypt('rahasia'),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => 1
            ],
            [
                'name' => 'Bendahara',
                'email' => 'bendahara@simkepon.app',
                'password' => bcrypt('rahasia'),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => 2
     ],
            [
                'name' => 'Wali Santri',
                'email' => 'walisantri@simkepon.app',
                'password' => bcrypt('rahasia'),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => 3
            ],
            [
                'name' => 'Kepala Pondok',
                'email' => 'kepalapondok@simkepon.app',
                'password' => bcrypt('rahasia'),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => 4
            ],
        ]);
    }
}
