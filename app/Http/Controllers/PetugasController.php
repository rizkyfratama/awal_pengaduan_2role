<?php
namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    // Menampilkan Dashboard Petugas (image_ce10b6.png)
    public function dashboard()
    {
        $stats = [
            'menunggu' => Pengaduan::where('status', 'menunggu')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai'  => Pengaduan::where('status', 'selesai')->count(),
            'ditolak'  => Pengaduan::where('status', 'ditolak')->count(),
        ];
        
        $terbaru = Pengaduan::where('status', 'menunggu')->orderBy('created_at', 'desc')->take(5)->get();
        
        return view('petugas.dashboard', compact('stats', 'terbaru'));
    }

    // Menampilkan Manajemen Pengaduan (image_ce10d7.png)
    public function index(Request $request)
    {
        $query = Pengaduan::with('kategori')->orderBy('created_at', 'desc');

        // Logic Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_tiket', 'like', "%{$search}%")
                  ->orWhere('judul', 'like', "%{$search}%")
                  ->orWhere('nama_pelapor', 'like', "%{$search}%")
                  ->orWhere('lokasi_kejadian', 'like', "%{$search}%");
            });
        }
        
        // Logic Filter Status
        if ($request->filled('status') && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        $pengaduans = $query->paginate(10)->withQueryString(); // withQueryString agar pagination tetap membawa filter

        return view('petugas.pengaduan_index', compact('pengaduans'));
    }

    // Menampilkan Detail Pengaduan (untuk memberi tanggapan)
    public function show(Pengaduan $pengaduan)
    {
        // Eager load relasi
        $pengaduan->load('kategori', 'user', 'tanggapans.petugas');
        return view('petugas.pengaduan_show', compact('pengaduan'));
    }

    // Proses Simpan Tanggapan
    public function storeTanggapan(Request $request, Pengaduan $pengaduan)
    {
        $request->validate(['tanggapan' => 'required|string']);

        Tanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'petugas_id' => Auth::id(),
            'tanggapan' => $request->tanggapan,
        ]);

        // Setelah diberi tanggapan, ubah status jadi 'diproses'
        $pengaduan->update(['status' => 'diproses']);

        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }

    // Proses Update Status (Selesai / Ditolak)
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate(['status' => 'required|in:diproses,selesai,ditolak']);

        $pengaduan->update(['status' => $request->status]);

        // Jika status 'selesai' atau 'ditolak', opsional kirim notifikasi
        // ... (logic notifikasi)

        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}