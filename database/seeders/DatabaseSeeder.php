<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat user khusus testing yang sudah memiliki API Key terdaftar
        User::create([
            'name' => 'Test User IoT',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin', // sesuaikan dengan role sistem Anda
            'api_key' => 'RAHASIA_API_KEY_123', // <--- API Key yang didaftarkan ke database
        ]);
    }
}