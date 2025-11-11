<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Import relasi
use Illuminate\Database\Eloquent\Relations\HasMany;   // <-- Import relasi

class Pengaduan extends Model
{
    use HasFactory;

    /**
     * Izinkan semua atribut diisi melalui create()
     * Alternatif selain $fillable jika semua field aman.
     */
    protected $guarded = [];

    /**
     * Relasi: Satu pengaduan milik satu Kategori.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi: Satu pengaduan milik satu User (Masyarakat).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu pengaduan bisa punya banyak Tanggapan.
     */
    public function tanggapans(): HasMany
    {
        return $this->hasMany(Tanggapan::class);
    }
}