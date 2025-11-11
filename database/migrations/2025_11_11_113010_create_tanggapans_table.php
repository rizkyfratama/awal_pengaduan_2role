<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengaduan_id')->constrained('pengaduans')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users'); // ID Petugas yang merespon
            $table->text('tanggapan'); // Isi tanggapan/tindak lanjut
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanggapans');
    }
};