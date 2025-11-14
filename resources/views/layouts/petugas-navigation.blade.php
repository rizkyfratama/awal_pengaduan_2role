<div class="flex flex-col justify-between h-full bg-[#0f1b2a] text-white">
    {{-- Bagian Profil --}}
    <div class="p-4 border-b border-gray-600 pb-4">
        <div class="flex items-center mb-2 space-x-3">
            {{-- Gambar profil --}}
            <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.png') }}" 
                 alt="Profile" 
                 class="w-16 h-16 rounded-full border-2 border-gray-500 object-cover">

            <div class="flex flex-col">
                {{-- Nama pengguna --}}
                <h2 class="text-sm font-semibold leading-tight">
                    {{ Auth::user()->name ?? 'Petugas' }}
                </h2>

                {{-- Role pengguna --}}
                <p class="text-xs text-gray-400 capitalize">
                    {{ Auth::user()->role ?? 'Petugas' }}
                </p>

                {{-- Lokasi --}}
                <p class="text-xs text-gray-400">Kota Banjarmasin</p>
            </div>
        </div>

        {{-- Link ke halaman profil --}}
        <a href="{{ route('profile.edit') }}" 
           class="text-xs text-emerald-400 hover:text-emerald-300 transition-colors">
            Edit Profil →
        </a>
    </div>

    {{-- Menu Navigasi --}}
    <div class="p-4 flex-1 overflow-y-auto">
        <nav class="space-y-1">
            <a href="{{ route('petugas.dashboard') }}" 
               class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200 
                      {{ request()->routeIs('petugas.dashboard') 
                         ? 'bg-emerald-600 text-white' 
                         : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                {{ __('Dashboard') }}
            </a>

            <a href="{{ route('petugas.pengaduan.index') }}" 
               class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200 
                      {{ request()->routeIs('petugas.pengaduan.*') 
                         ? 'bg-emerald-600 text-white' 
                         : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                {{ __('Pengaduan') }}
            </a>
        </nav>
    </div>
</div>
