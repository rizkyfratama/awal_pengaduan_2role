<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 md:p-8 text-center">
                <h2 class="text-2xl font-semibold mb-2">Layanan Pengaduan Masyarakat</h2>
                <p class="text-gray-600 mb-8">
                    Selamat datang, {{ Auth::user()->name }}! Sampaikan laporan terkait isu perempuan dan perlindungan anak melalui tombol di bawah ini.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <span class="inline-block bg-blue-600 text-white rounded-full h-10 w-10 leading-10 font-bold mb-2">1</span>
                        <h3 class="font-semibold mb-1">Sampaikan Laporan</h3>
                        <p class="text-sm text-gray-600">Isi formulir pengaduan dengan lengkap dan jelas.</p>
                    </div>
                    <div>
                        <span class="inline-block bg-blue-600 text-white rounded-full h-10 w-10 leading-10 font-bold mb-2">2</span>
                        <h3 class="font-semibold mb-1">Proses Verifikasi</h3>
                        <p class="text-sm text-gray-600">Tim kami akan memverifikasi dan memproses laporan Anda.</p>
                    </div>
                    <div>
                        <span class="inline-block bg-blue-600 text-white rounded-full h-10 w-10 leading-10 font-bold mb-2">3</span>
                        <h3 class="font-semibold mb-1">Tindak Lanjut</h3>
                        <p class="text-sm text-gray-600">Dapatkan update dan tindak lanjut dari laporan Anda.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('pengaduan.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700">
                        Buat Pengaduan Baru
                    </a>
                    <a href="{{ route('lacak.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-50">
                        Lacak Status Pengaduan
                    </a>
                </div>
            </div>

            <div class="mt-12">
                <h3 class="text-lg font-semibold mb-4 text-gray-700 text-center">Statistik Laporan Anda</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                        <p class="text-sm font-medium text-gray-500 uppercase">Total Kasus</p>
                        <p class="text-4xl font-bold text-gray-900 mt-1">{{ $stats['total'] }}</p>
                        <p class="text-sm text-gray-600 mt-1">Total laporan yang terkirim</p>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                        <p class="text-sm font-medium text-gray-500 uppercase">Kasus Ditangani</p>
                        <p class="text-4xl font-bold text-blue-600 mt-1">{{ $stats['ditangani'] }}</p>
                        <p class="text-sm text-gray-600 mt-1">Laporan yang diproses & selesai</p>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                        <p class="text-sm font-medium text-gray-500 uppercase">Kasus Selesai</p>
                        <p class="text-4xl font-bold text-green-600 mt-1">{{ $stats['selesai'] }}</p>
                        <p class="text-sm text-gray-600 mt-1">Laporan yang telah selesai</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>