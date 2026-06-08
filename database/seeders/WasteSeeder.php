<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\WasteCategory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WasteSeeder extends Seeder {
    public function run() {
        // Buat kategori
        WasteCategory::create(['name' => 'Organik', 'description' => 'Sampah sisa makanan']);
        WasteCategory::create(['name' => 'Anorganik', 'description' => 'Plastik dan botol']);

        // Buat user contoh untuk testing API Key
        User::create([
            'name' => 'Petugas IoT',
            'email' => 'iot@smartwaste.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'api_key' => 'SENSORKU-RAHASIA-123'
        ]);
    }
}