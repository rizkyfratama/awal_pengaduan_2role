<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pengaduan (Tiket: {{ $pengaduan->nomor_tiket }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold border-b pb-2 mb-4">Detail Laporan</h3>

                            <div class="mb-4">
                                <span class="text-sm font-medium">Status: </span>
                                @if ($pengaduan->status == 'menunggu')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                @elseif ($pengaduan->status == 'diproses')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Diproses
                                    </span>
                                @elseif ($pengaduan->status == 'selesai')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>
                                @elseif ($pengaduan->status == 'ditolak')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-3">
                                <p><strong>Nomor Tiket:</strong> {{ $pengaduan->nomor_tiket }}</p>
                                <p><strong>Tanggal Lapor:</strong> {{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                                <p><strong>Kategori:</strong> {{ $pengaduan->kategori->nama }}</p>
                                <p><strong>Judul Laporan:</strong> {{ $pengaduan->judul }}</p>
                                <p><strong>Lokasi Kejadian:</strong> {{ $pengaduan->lokasi_kejadian }}</p>
                                
                                <div class="border-t pt-3">
                                    <p><strong>Uraian Kejadian:</strong></p>
                                    <p class="text-gray-700 whitespace-pre-line">{{ $pengaduan->uraian }}</p>
                                </div>

                                @if ($pengaduan->foto)
                                    <div class="border-t pt-3">
                                        <p><strong>Foto Pendukung:</strong></p>
                                        <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto Pengaduan" class="mt-2 rounded-lg border w-full md:w-1/2">
                                    </div>
                                @endif
                            </div>

                            <hr class="my-6">

                            <h3 class="text-lg font-semibold border-b pb-2 mb-4">Data Pelapor</h3>
                            <div class="space-y-3">
                                <p><strong>Nama Pelapor:</strong> {{ $pengaduan->nama_pelapor }}</p>
                                <p><strong>Nomor Telepon:</strong> {{ $pengaduan->telepon_pelapor }}</p>
                                <p><strong>Email:</strong> {{ $pengaduan->email_pelapor ?? '-' }}</p>
                                <p><strong>Alamat:</strong> {{ $pengaduan->alamat_pelapor ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="md:col-span-1">
                            
                            <div class="bg-gray-50 p-4 rounded-lg border mb-6">
                                <h3 class="text-lg font-semibold mb-4">Ubah Status Laporan</h3>
                                <form action="{{ route('petugas.pengaduan.status', $pengaduan) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                        <option value="menunggu" {{ $pengaduan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <button type="submit" class="mt-3 w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        Perbarui Status
                                    </button>
                                </form>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg border">
                                <h3 class="text-lg font-semibold mb-4">Tindak Lanjut Petugas</h3>
                                
                                <form action="{{ route('petugas.tanggapan.store', $pengaduan) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="tanggapan" class="block text-sm font-medium text-gray-700">Tulis Tindak Lanjut</label>
                                        <textarea id="tanggapan" name="tanggapan" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('tanggapan') }}</textarea>
                                        @error('tanggapan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        Kirim Tanggapan
                                    </button>
                                </form>

                                <hr class="my-6">

                                <h4 class="font-semibold mb-3">Riwayat Tindak Lanjut</h4>
                                <div class="space-y-4">
                                    @forelse ($pengaduan->tanggapans as $tanggapan)
                                        <div class="border-l-4 border-blue-500 pl-3">
                                            <p class="text-sm text-gray-700">{{ $tanggapan->tanggapan }}</p>
                                            <small class="text-gray-500">
                                                Oleh: <strong>{{ $tanggapan->petugas->name }}</strong> 
                                                <br>
                                                Pada: {{ $tanggapan->created_at->format('d M Y, H:i') }}
                                            </small>
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500">Belum ada tindak lanjut.</p>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mt-6 border-t pt-4">
                        <a href="{{ route('petugas.pengaduan.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Kembali ke Manajemen Pengaduan
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>