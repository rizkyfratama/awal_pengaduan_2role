<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- Import DB

class PetugasController extends Controller
{
    /**
     * Mengambil statistik untuk dashboard.
     */
    public function dashboard(Request $request)
    {
        $stats = [
            'menunggu' => Pengaduan::where('status', 'menunggu')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai'  => Pengaduan::where('status', 'selesai')->count(),
            'ditolak'  => Pengaduan::where('status', 'ditolak')->count(),
            'total'    => Pengaduan::count(),
        ];
        
        $terbaru = Pengaduan::with('kategori')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();
        
        return response()->json([
            'stats' => $stats,
            'terbaru' => $terbaru
        ]);
    }

    /**
     * Menampilkan daftar semua pengaduan (dengan filter).
     */
    public function index(Request $request)
    {
        $query = Pengaduan::with('kategori')->orderBy('created_at', 'desc');

        // Filter by Status
        if ($request->filled('status') && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        // Search by Keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_tiket', 'like', "%{$search}%")
                  ->orWhere('judul', 'like', "%{$search}%")
                  ->orWhere('nama_pelapor', 'like', "%{$search}%");
            });
        }

        $pengaduans = $query->paginate(15); // Ambil 15 data per halaman

        return response()->json($pengaduans);
    }

    /**
     * Menampilkan detail satu pengaduan.
     */
    public function show(Pengaduan $pengaduan)
    {
        // Ambil relasi lengkap untuk detail
        $pengaduan->load('kategori', 'user', 'tanggapans.petugas');
        return response()->json($pengaduan);
    }

    /**
     * Menyimpan tanggapan baru dari petugas.
     */
    public function storeTanggapan(Request $request, Pengaduan $pengaduan)
    {
        $data = $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $tanggapan = $pengaduan->tanggapans()->create([
            'petugas_id' => Auth::id(), // Ambil ID petugas yang sedang login
            'tanggapan'  => $data['tanggapan'],
        ]);

        // Otomatis ubah status jadi 'diproses' jika masih 'menunggu'
        if ($pengaduan->status == 'menunggu') {
            $pengaduan->update(['status' => 'diproses']);
        }
        
        // Load relasi petugas untuk dikembalikan
        $tanggapan->load('petugas');

        return response()->json($tanggapan, 201); // 201 = Created
    }

    /**
     * Mengubah status pengaduan.
     */
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $data = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
        ]);

        $pengaduan->update(['status' => $data['status']]);

        return response()->json($pengaduan);
    }
}