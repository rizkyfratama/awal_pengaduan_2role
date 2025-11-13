<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display-swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen flex" x-data="{ openSidebar: false }">

    <aside class="bg-gray-900 text-white w-64 h-screen flex flex-col justify-between fixed z-30
                 transition-transform duration-300 ease-in-out"
           :class="openSidebar ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

        <div class="flex flex-col flex-1 overflow-y-auto">
            <nav class="pt-4 px-2 space-y-1"> 
                @if (Auth::user()->role == 'petugas')
                    @include('layouts.petugas-navigation')
                @else
                    @include('layouts.navigation')
                @endif
            </nav>
        </div>

        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="flex items-center w-full px-4 py-2 text-red-400 hover:bg-gray-700 rounded-lg">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3 3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col md:ml-64"> 

        <header class="bg-white shadow-md z-10">
            <div class="max-w-full mx-auto py-3 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    
                    <div class="flex items-center">
                        <button @click="openSidebar = !openSidebar" class="md:hidden p-2 text-gray-500 mr-2">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <img class="h-12 w-auto" 
                                 src="{{ asset('images/logo-dp3a.png') }}" 
                                 alt="Logo">
                            
                            <div class="ml-3">
                                <div class="font-bold text-base text-gray-800">Dinas Pemberdayaan Perempuan dan Perlindungan Anak</div>
                                <div class="text-sm text-gray-500">Kota Banjarmasin</div>
                            </div>
                        </a>
                    </div>

                    <div class="flex items-center">
                        <div class="text-right mr-4 hidden sm:block">
                            <div class="font-medium text-sm text-gray-800">Selamat datang, {{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">Portal Pengaduan DP3A Kota Banjarmasin</div>
                        </div>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 focus:outline-none">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                </div>
            </div>
        </header>
        <main class="flex-1 overflow-y-auto p-8 bg-gray-100">
            {{ $slot }}
        </main>
    </div>

    <div @click="openSidebar = false"
         x-show="openSidebar"
         class="fixed inset-0 bg-black opacity-50 z-10 md:hidden"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:leave="transition-opacity ease-in duration-300">
    </div>
</div>
</body>
</html>