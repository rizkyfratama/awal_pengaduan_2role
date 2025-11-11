<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create(['nama' => 'Kekerasan terhadap Perempuan']);
        Kategori::create(['nama' => 'Penelantaran Anak']);
        Kategori::create(['nama' => 'Diskriminasi Gender']);
        Kategori::create(['nama' => 'Eksploitasi Anak']);
        Kategori::create(['nama' => 'Pemberdayaan Ekonomi Perempuan']);
        Kategori::create(['nama' => 'Lainnya']);
    }
}