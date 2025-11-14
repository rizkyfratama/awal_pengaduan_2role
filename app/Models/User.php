<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan role
        'profile_photo_path', // Tambahkan agar bisa diisi otomatis saat upload
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: Satu user (masyarakat) bisa punya banyak pengaduan.
     */
    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }

    /**
     * Relasi: Satu user (petugas) bisa memberi banyak tanggapan.
     */
    public function tanggapans(): HasMany
    {
        return $this->hasMany(Tanggapan::class, 'petugas_id');
    }

    /**
     * Akses URL foto profil user (otomatis pilih default jika belum ada).
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }

        // Jika belum upload, gunakan avatar default
        return asset('images/default-avatar.png');
    }
}
