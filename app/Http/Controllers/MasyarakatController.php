<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MasyarakatController extends Controller
{
    // Menampilkan Beranda Masyarakat (image_ce1498.png)
    public function beranda()
    {
        $stats = [
            'total' => Pengaduan::count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
            'ditangani' => Pengaduan::whereIn('status', ['diproses', 'selesai'])->count(), // Asumsi 'Kasus Ditangani'
        ];
        return view('dashboard', compact('stats')); // 'dashboard' adalah view bawaan Breeze
    }

    // Menampilkan Form Buat Pengaduan (image_ce17be.png)
    public function createPengaduan()
    {
        $kategoris = Kategori::all();
        return view('masyarakat.pengaduan_create', compact('kategoris'));
    }

    // Menyimpan data pengaduan baru
    public function storePengaduan(Request $request)
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB
        ]);

        // 1. Handle Upload Foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pengaduan', 'public');
        }

        // 2. Buat Nomor Tiket Unik
        $data['nomor_tiket'] = 'PGD-' . now()->timestamp . Str::upper(Str::random(3));
        
        // 3. Set user_id dari user yang login
        $data['user_id'] = Auth::id();

        // 4. Set status default
        $data['status'] = 'menunggu';

        // 5. Simpan ke database
        Pengaduan::create($data);

        return redirect()->route('pengaduan.saya')->with('success', 'Laporan berhasil dikirim! Nomor Tiket Anda: ' . $data['nomor_tiket']);
    }

    // Menampilkan halaman "Pengaduan Saya" (image_ce17ff.png)
    public function showPengaduanSaya()
    {
        $pengaduans = Auth::user()->pengaduans()->with('kategori')->orderBy('created_at', 'desc')->get();
        return view('masyarakat.pengaduan_saya', compact('pengaduans'));
    }

    // Menampilkan halaman Lacak Status (image_ce17df.png)
    public function lacakIndex()
    {
        return view('masyarakat.lacak_index');
    }

    // Memproses & Menampilkan hasil lacak
    public function lacakShow(Request $request)
    {
        $request->validate(['nomor_tiket' => 'required|string']);
        $pengaduan = Pengaduan::where('nomor_tiket', $request->nomor_tiket)
                               ->with('kategori', 'tanggapans.petugas')
                               ->first();
        
        if (!$pengaduan) {
            return back()->with('error', 'Nomor tiket tidak ditemukan.');
        }

        return view('masyarakat.lacak_show', compact('pengaduan'));
    }

    // Menampilkan halaman Kontak Dinas (image_ce181e.png)
    public function kontak()
    {
        return view('masyarakat.kontak');
    }
}