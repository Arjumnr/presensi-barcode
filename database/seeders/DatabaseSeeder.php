<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // admin

        
        
        DB::table('users')->insert([
            [
                'nim' => '11223344',
                'email' => 'abong@gmail.com',
                'name' => 'Andi Adhe Amalya',
                'username' => 'admin',
                'password' => bcrypt('abongjelek'),
                'phone' => '08123456789',
                'role' => 'admin',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ], 
            [
                'nim' => '1212121',
                'email' => 'arjum@gmail.com',
                'name' => 'Arjum',
                'username' => 'arjum',
                'password' => bcrypt('11223344'),
                'phone' => '08123456789',
                'role' => 'user',
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);


        DB::table('session_timetable')->insert([
            [
            'matkul' => 'Manajemen Strategik Sektor Publik',
            'date_session' => now()->format('Y-m-d'), 
            'start_time' => '08:00:00',
            'end_time' => '09:45:00',
            ],
        ]);


    }
}
