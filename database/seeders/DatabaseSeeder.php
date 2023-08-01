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
//
        $data = [
            [
                'name' => 'andy',
                'email' => 'andy@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '1',
            ],
            [
                'name' => 'john',
                'email' => 'john@gmail.com',
                'password' => bcrypt('123456'),
                'role' => '2',
            ],
        ];
        DB::table('users')->insert($data);
    }
    
}
