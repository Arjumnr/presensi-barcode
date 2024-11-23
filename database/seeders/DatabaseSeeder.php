<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // admin
        
        \App\Models\User::factory()->create([
            'name' => 'Andi Adhe Amalya',
            'username' => 'admin',
            'password' => bcrypt('abongjelek'),
            'role' => 'admin',
        ]);

    }
}
