<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\PetugasController;

// Rute Publik (Tidak perlu token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// RUTE BARU (PUBLIK): Mengambil daftar kategori
Route::get('/kategori', [KategoriController::class, 'index']);
// RUTE BARU (PUBLIK): Melacak pengaduan via nomor tiket
Route::get('/lacak', [PengaduanController::class, 'lacak']);

// Rute Terproteksi (Wajib pakai token / 'auth:sanctum')
Route::middleware('auth:sanctum')->group(function () {
    
    // Rute untuk data User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rute untuk data Pengaduan
    Route::get('/pengaduan', [PengaduanController::class, 'index']);
    Route::post('/pengaduan', [PengaduanController::class, 'store']);

    Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'api.role:petugas'])->prefix('petugas')->group(function () {
    
    // Rute untuk statistik dashboard
    Route::get('/dashboard', [PetugasController::class, 'dashboard']);

    // Rute untuk daftar semua pengaduan
    Route::get('/pengaduan', [PetugasController::class, 'index']);

    // Rute untuk melihat detail 1 pengaduan
    Route::get('/pengaduan/{pengaduan}', [PetugasController::class, 'show']);

    // Rute untuk mengirim tanggapan
    Route::post('/pengaduan/{pengaduan}/tanggapan', [PetugasController::class, 'storeTanggapan']);

    // Rute untuk mengubah status
    Route::put('/pengaduan/{pengaduan}/status', [PetugasController::class, 'updateStatus']);
});