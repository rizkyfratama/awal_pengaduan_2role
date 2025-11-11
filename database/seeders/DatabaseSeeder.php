<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder yang kita buat
        $this->call([
            KategoriSeeder::class,
            PetugasSeeder::class,
        ]);
    }
}