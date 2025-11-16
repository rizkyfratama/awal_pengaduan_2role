<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MasyarakatController; // <-- Buat ini
use App\Http\Controllers\PetugasController; // <-- Buat ini

// Redirect root ke /login agar langsung menuju halaman login
Route::get('/', function () {
    return redirect('/login');
});

// === RUTE PUBLIK (Bisa diakses tanpa login) ===
Route::get('/beranda', [MasyarakatController::class, 'beranda'])->name('beranda');
Route::get('/kontak-dinas', [MasyarakatController::class, 'kontak'])->name('kontak');
Route::get('/lacak-pengaduan', [MasyarakatController::class, 'lacakIndex'])->name('lacak.index');
Route::post('/lacak-pengaduan', [MasyarakatController::class, 'lacakShow'])->name('lacak.show');

// === RUTE MASYARAKAT (Harus login & role: masyarakat) ===
Route::middleware(['auth', 'verified', 'role:masyarakat'])->group(function () {
    // 'dashboard' bawaan Breeze akan kita ubah jadi beranda masyarakat
    Route::get('/dashboard', [MasyarakatController::class, 'beranda'])->name('dashboard');

    // Halaman Form Buat Pengaduan
    Route::get('/buat-pengaduan', [MasyarakatController::class, 'createPengaduan'])->name('pengaduan.create');
    // Proses Simpan Pengaduan
    Route::post('/buat-pengaduan', [MasyarakatController::class, 'storePengaduan'])->name('pengaduan.store');
    
    // Halaman Riwayat "Pengaduan Saya"
    Route::get('/pengaduan-saya', [MasyarakatController::class, 'showPengaduanSaya'])->name('pengaduan.saya');
});

// === RUTE PETUGAS (Harus login & role: petugas) ===
Route::middleware(['auth', 'verified', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'dashboard'])->name('dashboard');
    
    // Manajemen Pengaduan
    Route::get('/pengaduan', [PetugasController::class, 'index'])->name('pengaduan.index');
    // Detail Pengaduan
    Route::get('/pengaduan/{pengaduan}', [PetugasController::class, 'show'])->name('pengaduan.show');
    
    // Proses Update Status
    Route::put('/pengaduan/{pengaduan}/status', [PetugasController::class, 'updateStatus'])->name('pengaduan.status');
    // Proses Kirim Tanggapan
    Route::post('/pengaduan/{pengaduan}/tanggapan', [PetugasController::class, 'storeTanggapan'])->name('tanggapan.store');
});

// === RUTE PROFIL (Bawaan Breeze, untuk semua role) ===
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat file rute autentikasi (login, register, dll)
require __DIR__.'/auth.php';
