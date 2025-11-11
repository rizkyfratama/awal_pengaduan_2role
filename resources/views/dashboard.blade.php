<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Ini adalah halaman beranda Layanan Pengaduan DP3A Kota Banjarmasin.
                        Anda dapat membuat laporan baru, melihat riwayat, atau melacak status laporan Anda melalui menu di samping.
                    </p>
                </div>
            </div>

            <h3 class="text-lg font-semibold mb-4 text-gray-700">Statistik Laporan Anda</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Kasus</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                        <p class="text-sm text-gray-600 mt-1">Total laporan yang terkirim</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Kasus Ditangani</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $stats['ditangani'] }}</p>
                        <p class="text-sm text-gray-600 mt-1">Laporan yang diproses & selesai</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Kasus Selesai</p>
                        <p class="text-3xl font-bold text-green-600">{{ $stats['selesai'] }}</p>
                        <p class="text-sm text-gray-600 mt-1">Laporan yang telah selesai</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>