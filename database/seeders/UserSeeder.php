<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            "password" => Hash::make('password'),
            "is_admin" => true
        ]);


        User::factory()->create([
            'name' => 'user',
            'email' => 'user@test.com',
            "password" => Hash::make('password'),
            "is_admin" => false
        ]);
    }
}
