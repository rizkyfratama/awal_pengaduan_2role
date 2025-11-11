<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lacak Status Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Lacak Laporan Anda</h3>
                    <p class="mb-6 text-gray-600">
                        Silakan masukkan Nomor Tiket Pengaduan yang Anda dapatkan saat membuat laporan untuk melihat status dan tindak lanjutnya.
                    </p>

                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('lacak.show') }}" method="POST">
                        @csrf
                        <div>
                            <label for="nomor_tiket" class="block text-sm font-medium text-gray-700">Nomor Tiket *</label>
                            <input type="text" name="nomor_tiket" id="nomor_tiket"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                   placeholder="Contoh: PGD-1731308007ABC"
                                   value="{{ old('nomor_tiket') }}" required>
                            @error('nomor_tiket')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                Lacak Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>