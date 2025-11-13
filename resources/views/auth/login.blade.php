<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Pengaduan DP3A</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="flex bg-white rounded-xl shadow-lg overflow-hidden w-[900px] max-w-full">
        <div class="bg-[#0A132E] text-white flex flex-col justify-center items-center w-1/2 p-8">
            <div class="bg-white rounded-lg p-4 mb-6">
                <img src="{{ asset('images/logo-dp3a.png') }}" alt="Logo DP3A" class="w-55">
            </div>

            <h2 class="text-2xl font-bold mb-2 text-center">Selamat Datang di</h2>
            <h3 class="text-xl font-semibold text-center">Portal Pengaduan DP3A</h3>
            <p class="text-sm mt-4 text-center">
                Dinas Pemberdayaan Perempuan dan Perlindungan Anak<br>
                <span class="font-semibold">Kota Banjarmasin</span>
            </p>
        </div>

        <div class="w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Login</h2>
            <p class="text-sm text-gray-500 mb-6">Masuk ke sistem pengaduan masyarakat</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0A132E] focus:outline-none"
                        placeholder="Masukkan email Anda"
                        value="{{ old('email') }}"> </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0A132E] focus:outline-none"
                        placeholder="Masukkan password Anda">
                </div>

                <button type="submit"
                    class="w-full bg-[#0A132E] text-white font-semibold py-2 rounded-lg hover:bg-[#151f47] transition">
                    Login
                </button>
            </form>

            <div class="flex justify-between items-center mt-4 text-sm">
                
                <a href="{{ route('password.request') }}" class="text-[#0A132E] hover:underline">
                    Lupa password?
                </a>
                
                <a href="{{ route('register') }}" class="text-[#0A132E] hover:underline">
                    Daftar
                </a>

                </div>
        </div>
    </div>
</body>
</html>