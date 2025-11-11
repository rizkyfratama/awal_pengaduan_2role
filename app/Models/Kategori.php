<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Import relasi

class Kategori extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi.
     */
    protected $fillable = ['nama'];

    /**
     * Relasi: Satu kategori bisa ada di banyak pengaduan.
     */
    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}