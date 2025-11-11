<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Lacak Status (Tiket: ' . $pengaduan->nomor_tiket . ')') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">

                    <h3 class="text-xl font-semibold mb-4">Detail Pengaduan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Nomor Tiket</p>
                            <p class="font-medium text-indigo-600">{{ $pengaduan->nomor_tiket }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Lapor</p>
                            <p class="font-medium">{{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kategori</p>
                            <p class="font-medium">{{ $pengaduan->kategori->nama }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Judul Laporan</p>
                            <p class="font-medium">{{ $pengaduan->judul }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-sm text-gray-500">Status Terkini</p>
                        <div class="mt-1">
                            @if ($pengaduan->status == 'menunggu')
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                            @elseif ($pengaduan->status == 'diproses')
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Diproses
                                </span>
                            @elseif ($pengaduan->status == 'selesai')
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            @elseif ($pengaduan->status == 'ditolak')
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <hr class="my-6">

                    <h3 class="text-xl font-semibold mb-4">Riwayat Tindak Lanjut</h3>
                    <div class="space-y-6">
                        @forelse ($pengaduan->tanggapans as $tanggapan)
                            <div class="border-l-4 border-blue-500 pl-4">
                                <p class="text-gray-700 whitespace-pre-line">{{ $tanggapan->tanggapan }}</p>
                                <small class="text-gray-500">
                                    Ditanggapi oleh: <strong>{{ $tanggapan->petugas->name }}</strong> 
                                    <br>
                                    Pada: {{ $tanggapan->created_at->format('d M Y, H:i') }}
                                </small>
                            </div>
                        @empty
                            <div class="border-l-4 border-gray-300 pl-4">
                                <p class="text-gray-500 italic">Belum ada tindak lanjut dari petugas.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8 border-t pt-6">
                        <a href="{{ route('lacak.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Lacak Laporan Lain
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>