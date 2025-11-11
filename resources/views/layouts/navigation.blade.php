<div class="p-4 space-y-2">
    
    <a href="{{ route('dashboard') }}" 
       class="flex items-center w-full px-4 py-2 rounded-lg transition-colors duration-200 
              {{ request()->routeIs('dashboard') 
                 ? 'bg-green-600 text-white' 
                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        {{ __('Beranda') }}
    </a>

    <a href="{{ route('pengaduan.create') }}" 
       class="flex items-center w-full px-4 py-2 rounded-lg transition-colors duration-200 
              {{ request()->routeIs('pengaduan.create') 
                 ? 'bg-green-600 text-white' 
                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
        {{ __('Buat Pengaduan') }}
    </a>

    <a href="{{ route('lacak.index') }}" 
       class="flex items-center w-full px-4 py-2 rounded-lg transition-colors duration-200 
              {{ request()->routeIs('lacak.index') 
                 ? 'bg-green-600 text-white' 
                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        {{ __('Lacak Pengaduan') }}
    </a>

    <a href="{{ route('pengaduan.saya') }}" 
       class="flex items-center w-full px-4 py-2 rounded-lg transition-colors duration-200 
              {{ request()->routeIs('pengaduan.saya') 
                 ? 'bg-green-600 text-white' 
                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        {{ __('Pengaduan Saya') }}
    </a>

    <a href="{{ route('kontak') }}" 
       class="flex items-center w-full px-4 py-2 rounded-lg transition-colors duration-200 
              {{ request()->routeIs('kontak') 
                 ? 'bg-green-600 text-white' 
                 : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.3 1.15a11.042 11.042 0 005.57 5.57l1.15-2.3a1 1 0 011.21-.502l4.493 1.498A1 1 0 0119 16.72V20a2 2 0 01-2 2h-1C9.716 22 3 15.284 3 7V5z"></path></svg>
        {{ __('Kontak Dinas') }}
    </a>

</div>