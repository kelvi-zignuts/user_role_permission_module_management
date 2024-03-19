<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'first_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ]);
    }
}