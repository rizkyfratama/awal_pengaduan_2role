<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaduan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="space-y-6">
                
                @forelse ($pengaduans as $laporan)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            
                            <div class="flex justify-between items-center mb-4 border-b pb-4">
                                <div>
                                    <span class="text-sm text-gray-500">Nomor Tiket</span>
                                    <p class="font-bold text-indigo-600">{{ $laporan->nomor_tiket }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm text-gray-500">Tanggal Lapor</span>
                                    <p class="font-medium text-gray-700">{{ $laporan->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <div>
                                <span class="text-sm text-gray-500">Judul Pengaduan</span>
                                <h3 class="text-lg font-semibold mt-1">{{ $laporan->judul }}</h3>
                            </div>

                            <div class="mt-6 pt-4 border-t">
                                <span class="text-sm text-gray-500">Status</span>
                                <div class="mt-1">
                                    @if ($laporan->status == 'menunggu')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu
                                        </span>
                                    @elseif ($laporan->status == 'diproses')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Diproses
                                        </span>
                                    @elseif ($laporan->status == 'selesai')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                    @elseif ($laporan->status == 'ditolak')
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 text-center">
                            <p class="text-gray-500">Anda belum pernah membuat pengaduan.</p>
                            <a href="{{ route('pengaduan.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                Buat Pengaduan Pertama Anda
                            </a>
                        </div>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>