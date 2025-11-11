<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Petugas DP3A',
            'email' => 'petugas@dp3a.com',
            'password' => Hash::make('password123'), // Ganti dengan password aman
            'role' => 'petugas',
            'email_verified_at' => now(),
        ]);
    }
}