<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Akun pembuat
            $table->foreignId('kategori_id')->constrained('kategoris');
            
            $table->string('nomor_tiket')->unique(); // Cth: PGD-123456
            
            // Data Pelapor (sesuai form)
            $table->string('nama_pelapor');
            $table->string('telepon_pelapor');
            $table->string('email_pelapor')->nullable();
            $table->text('alamat_pelapor')->nullable();
            
            // Detail Pengaduan (sesuai form)
            $table->string('judul');
            $table->text('uraian');
            $table->string('lokasi_kejadian');
            $table->string('foto')->nullable(); // Path/nama file foto
            
            // Status
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            
            $table->timestamps(); // Tanggal pengaduan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};