<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SampleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 Doctors
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Doctor ' . $i,
                'email' => 'doctor' . $i . '@medconnect.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'image' => 'https://randomuser.me/api/portraits/men/' . $i . '.jpg',
            ]);
        }

        // Create 10 Users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@medconnect.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'image' => 'https://randomuser.me/api/portraits/women/' . $i . '.jpg',
            ]);
        }
    }
}
