<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan; // <-- Pastikan ini ada
use Illuminate\Support\Str; // <-- Pastikan ini ada

class PengaduanController extends Controller
{
    /**
     * Mengambil daftar "Pengaduan Saya"
     */
    public function index(Request $request)
    {
        $pengaduans = $request->user()->pengaduans()
                            ->with('kategori')
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        return response()->json($pengaduans);
    }

    /**
     * Membuat pengaduan baru via API
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'telepon_pelapor' => 'required|string|max:20',
            'email_pelapor' => 'nullable|email',
            'alamat_pelapor' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'uraian' => 'required|string',
            'lokasi_kejadian' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // 1. Handle Upload Foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengaduan', 'public');
        }

        // 2. Buat Nomor Tiket Unik
        $data['nomor_tiket'] = 'PGD-' . now()->timestamp . Str::upper(Str::random(3));
        
        // 3. Set status default
        $data['status'] = 'menunggu';

        // 4. Simpan ke database menggunakan relasi dari user yang terautentikasi
        $pengaduan = $request->user()->pengaduans()->create($data);

        return response()->json($pengaduan, 201); // 201 = Created
    }

    //=================================================
    // METHOD BARU 1: Menampilkan detail 1 pengaduan
    //=================================================
    public function show(Request $request, Pengaduan $pengaduan)
    {
        // Keamanan: Pastikan user yang login adalah pemilik pengaduan
        if ($request->user()->id !== $pengaduan->user_id) {
            return response()->json(['message' => 'Akses ditolak'], 403); // 403 = Forbidden
        }

        // Ambil data pengaduan, beserta data kategori dan semua tanggapannya
        // Kita juga menyertakan data 'petugas' yang memberi tanggapan
        $pengaduan->load('kategori', 'tanggapans.petugas');

        return response()->json($pengaduan);
    }

    //=================================================
    // METHOD BARU 2: Lacak pengaduan (Publik)
    //=================================================
    public function lacak(Request $request)
    {
        $request->validate([
            'nomor_tiket' => 'required|string|exists:pengaduans,nomor_tiket'
        ]);

        $pengaduan = Pengaduan::where('nomor_tiket', $request->nomor_tiket)
                                ->with('kategori', 'tanggapans.petugas') // Ambil juga relasinya
                                ->first();
        
        if (!$pengaduan) {
             return response()->json(['message' => 'Nomor tiket tidak ditemukan'], 404);
        }

        return response()->json($pengaduan);
    }
    
} // <-- PASTIKAN HANYA ADA SATU KURUNG KURAWAL PENUTUP INI DI AKHIR