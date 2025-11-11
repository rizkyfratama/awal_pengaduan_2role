<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="min-h-screen flex" x-data="{ openSidebar: false }">

    <!-- SIDEBAR -->
    <aside class="bg-gray-900 text-white w-64 h-screen flex flex-col justify-between fixed z-30
                   transition-transform duration-300 ease-in-out"
           :class="openSidebar ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

        <!-- Logo -->
        <div class="flex flex-col flex-1 overflow-y-auto">
            <div class="flex items-center justify-center h-16 bg-gray-800">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-white" />
                </a>
            </div>

            <!-- Navigasi -->
            <nav class="mt-6 px-2 space-y-1">
                @if (Auth::user()->role == 'petugas')
                    @include('layouts.petugas-navigation')
                @else
                    @include('layouts.navigation')
                @endif
            </nav>
        </div>

        <!-- Tombol Logout -->
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="flex items-center w-full px-4 py-2 text-red-400 hover:bg-gray-700 rounded-lg">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <div class="flex-1 flex flex-col ml-64">

        <!-- HEADER -->
        <header class="bg-white shadow-md z-10">
            <div class="py-4 px-8 flex justify-between items-center">

                <!-- Tombol Sidebar (Mobile) -->
                <button @click="openSidebar = !openSidebar" class="md:hidden p-2 text-gray-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Judul Halaman -->
                <h2 class="font-semibold text-xl text-gray-800 leading-tight hidden md:block">
                    {{ $header ?? 'Beranda' }}
                </h2>

                <!-- Dropdown User -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
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
        </header>

        <!-- ISI HALAMAN -->
        <main class="flex-1 overflow-y-auto p-8 bg-gray-100">
            {{ $slot }}
        </main>
    </div>

    <!-- Overlay (untuk mobile) -->
    <div @click="openSidebar = false"
         x-show="openSidebar"
         class="fixed inset-0 bg-black opacity-50 z-10 md:hidden"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:leave="transition-opacity ease-in duration-300">
    </div>
</div>
</body>
</html>
