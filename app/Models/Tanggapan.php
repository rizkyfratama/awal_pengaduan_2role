<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Import relasi

class Tanggapan extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi.
     */
    protected $fillable = [
        'pengaduan_id', 
        'petugas_id', 
        'tanggapan'
    ];

    /**
     * Relasi: Satu tanggapan milik satu Pengaduan.
     */
    public function pengaduan(): BelongsTo
    {
        return $this->belongsTo(Pengaduan::class);
    }

    /**
     * Relasi: Satu tanggapan milik satu User (Petugas).
     * Kita perlu spesifikasikan foreign key 'petugas_id'
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}