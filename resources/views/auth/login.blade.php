<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Pengaduan DP3A</title>
    @vite('resources/css/app.css')

    <style>
        .slider-wrapper {
            width: 300%;
            display: flex;
        }
        .half {
            width: 33.3333%;
        }

        /* ---------------- Background videos ---------------- */
        /* blurred, enlarged video that fills the whole screen and provides blurred sides */
        .bg-blur-video {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%) scale(1.15); /* sedikit diperbesar supaya sisi terisi */
            width: 130vw;            /* lebih lebar dari viewport agar menutupi sisi putih */
            height: 100vh;
            object-fit: cover;
            object-position: center center;
            filter: blur(18px) brightness(0.7);
            z-index: -4;
            pointer-events: none;
        }

        /* main video yang terlihat di tengah, atas terlihat, bawah terpotong */
        .bg-video {
            position: fixed;
            top: 0;                   /* mulai dari paling atas agar bagian atas tidak terpotong */
            left: 50%;
            transform: translateX(-50%);
            width: auto;              /* biarkan proporsional, tinggi mengikuti viewport */
            height: 100vh;
            object-fit: cover;
            object-position: top center; /* tampilkan bagian atas video, bawah terpotong */
            z-index: -3;
            pointer-events: none;
        }

        /* Overlay gelap (BLUR + GELAP) */
        .bg-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(4px);
            z-index: -2;
            transition: all 0.6s ease;
            pointer-events: none;
        }

        /* Saat lihat video → overlay hilang */
        .overlay-hidden {
            background: rgba(0,0,0,0);
            backdrop-filter: blur(0px);
        }

        /* ---------------- Animasi shake ---------------- */
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            50% { transform: translateX(8px); }
            75% { transform: translateX(-8px); }
            100% { transform: translateX(0); }
        }
        .animate-shake {
            animation: shake 0.5s ease;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- 🔊 Tombol mute/unmute -->
    <button id="audioToggle"
        class="absolute top-5 right-5 z-50 bg-white/70 px-4 py-2 rounded-lg shadow text-black font-semibold">
        🔇
    </button>

    <!-- 👁️ Tombol lihat video / kembali -->
    <button id="toggleView"
        class="absolute top-5 left-5 z-50 bg-white/70 px-4 py-2 rounded-lg shadow text-black font-semibold">
        Lihat Video
    </button>

    <!-- Blurred background video (membuat sisi kiri/kanan tampak seperti video blur) -->
    <video id="bgBlur" autoplay loop playsinline muted class="bg-blur-video" aria-hidden="true">
        <source src="{{ asset('videos/bg.mp4') }}" type="video/mp4">
    </video>

    <!-- Main background video (tampil di tengah, atas terlihat) -->
    <video id="bgVideo" autoplay loop playsinline muted class="bg-video" aria-hidden="true">
        <source src="{{ asset('videos/bg.mp4') }}" type="video/mp4">
    </video>

    <!-- Overlay gelap + blur normal (dinonaktifkan saat "lihat video") -->
    <div id="overlay" class="bg-overlay"></div>

    <!-- ================= LOGIN BOX WRAPPER ================= -->
    <div id="loginBox" class="bg-white/80 backdrop-blur-xl rounded-xl shadow-lg overflow-hidden w-[700px] max-w-full relative z-10 transition-all duration-500">

        {{-- ================= SLIDER PANEL ================= --}}
        <div id="slider" class="slider-wrapper">

            {{-- ================= FORGOT PASSWORD ================= --}}
            <div class="half flex">
                <div class="bg-[#0A132E]/90 text-white flex flex-col justify-center items-center w-1/2 p-8 backdrop-blur-lg">
                    <div class="bg-white rounded-lg p-4 mb-6 shadow-lg">
                        <img src="{{ asset('images/logo-dp3a.png') }}" class="w-55">
                    </div>
                    <h2 class="text-2xl font-bold text-center">Lupa Password Anda?</h2>
                    <p class="text-sm mt-4 text-center">
                        Masukkan email Anda dan kami akan mengirim link reset password.
                    </p>
                </div>

                <div class="w-1/2 p-6 flex flex-col justify-center">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Reset Password</h2>
                    <p class="text-sm text-gray-500 mb-6">Masukkan email terdaftar Anda.</p>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input name="email" type="email" required
                                class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#0A132E]"
                                placeholder="Email terdaftar"
                                value="{{ old('email') }}">
                        </div>

                        <button class="w-full bg-[#0A132E] text-white py-2 rounded-lg hover:bg-[#151f47]">
                            Kirim Link Reset
                        </button>
                    </form>

                    <div class="text-right mt-4 text-sm">
                        <button id="toLoginFromForgot" class="text-[#0A132E] hover:underline">
                            Kembali ke Login
                        </button>
                    </div>
                </div>
            </div>

            {{-- ================= LOGIN PANEL ================= --}}
            <div class="half flex">
                <div class="bg-[#0A132E]/90 text-white flex flex-col justify-center items-center w-1/2 p-6 backdrop-blur-lg">
                    <div class="bg-white rounded-lg p-4 mb-6 shadow-lg">
                        <img src="{{ asset('images/logo-dp3a.png') }}" class="w-55">
                    </div>

                    <h2 class="text-2xl font-bold text-center">Selamat Datang di</h2>
                    <h3 class="text-xl font-semibold text-center">Portal Pengaduan DP3A</h3>
                    <p class="text-sm mt-4 text-center">
                        Dinas Pemberdayaan Perempuan dan Perlindungan Anak<br>
                        <span class="font-semibold">Kota Banjarmasin</span>
                    </p>
                </div>

                <div class="w-1/2 p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-semibold mb-2">Login</h2>
                    <p class="text-sm text-gray-500 mb-6">Masuk ke sistem</p>

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input id="email" type="email" name="email" required
                                class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#0A132E]"
                                placeholder="Masukkan email"
                                value="{{ old('email') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Password</label>
                            <input id="password" type="password" name="password" required
                                class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#0A132E]"
                                placeholder="Masukkan password">
                        </div>

                        <button class="w-full bg-[#0A132E] text-white py-2 rounded-lg hover:bg-[#151f47]">
                            Login
                        </button>

                        @if ($errors->any())
                            <div id="errorMessage" class="text-red-600 text-sm mt-2">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div id="errorMessage" class="text-red-600 text-sm mt-2">
                                {{ session('error') }}
                            </div>
                        @endif
                    </form>

                    <div class="flex justify-between mt-4 text-sm">
                        <button id="toForgot" class="text-[#0A132E] hover:underline">Lupa password?</button>
                        <button id="toRegister" class="text-[#0A132E] hover:underline">Daftar</button>
                    </div>
                </div>
            </div>

            {{-- ================= REGISTER PANEL ================= --}}
            <div class="half flex">
                <div class="bg-[#0A132E]/90 text-white flex flex-col justify-center items-center w-1/2 p-8">
                    <div class="bg-white rounded-lg p-4 mb-6 shadow-lg">
                        <img src="{{ asset('images/logo-dp3a.png') }}" class="w-55">
                    </div>
                    <h2 class="text-2xl font-bold text-center">Buat Akun Baru</h2>
                    <p class="text-sm mt-4 text-center">Untuk mengakses Portal Pengaduan DP3A</p>
                </div>

                <div class="w-1/2 p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-semibold mb-2">Daftar</h2>
                    <p class="text-sm text-gray-500 mb-6">Buat akun baru Anda</p>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium">Nama</label>
                            <input name="name" type="text" required class="mt-1 w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input name="email" type="email" required class="mt-1 w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Password</label>
                            <input name="password" type="password" required class="mt-1 w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Konfirmasi Password</label>
                            <input name="password_confirmation" type="password" required class="mt-1 w-full px-4 py-2 border rounded-lg">
                        </div>

                        <button class="w-full bg-[#0A132E] text-white py-2 rounded-lg hover:bg-[#151f47]">
                            Daftar
                        </button>
                    </form>

                    <div class="text-right mt-4 text-sm">
                        <button id="toLoginFromRegister" class="text-[#0A132E] hover:underline">
                            Sudah punya akun?
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script>
    // ================= SLIDER =================
    const slider = document.getElementById('slider');
    slider.style.transition = 'none';
    slider.style.transform = 'translateX(-33.3333%)';

    setTimeout(() => {
        slider.style.transition = 'transform 0.6s ease-in-out';
    }, 50);

    document.getElementById('toRegister').onclick = () => slider.style.transform = 'translateX(-66.6666%)';
    document.getElementById('toForgot').onclick = () => slider.style.transform = 'translateX(0)';
    document.getElementById('toLoginFromRegister').onclick = () => slider.style.transform = 'translateX(-33.3333%)';
    document.getElementById('toLoginFromForgot').onclick = () => slider.style.transform = 'translateX(-33.3333%)';

    // ================= AUDIO =================
    const video = document.getElementById('bgVideo');
    const videoBlur = document.getElementById('bgBlur');
    const audioBtn = document.getElementById('audioToggle');
    video.volume = 0.3;
    videoBlur.volume = 0; // blur video muted (no extra sound)
    audioBtn.addEventListener('click', () => {
        // toggle sound on the main video only
        video.muted = !video.muted;
        audioBtn.textContent = video.muted ? "🔇" : "🔊";
    });

    // ================= TOGGLE VIEW (ANIMASI FADE) =================
    const loginBox = document.getElementById("loginBox");
    const toggleBtn = document.getElementById("toggleView");
    const overlay = document.getElementById("overlay");
    let boxVisible = true;

    toggleBtn.addEventListener("click", () => {
        boxVisible = !boxVisible;

        if (boxVisible) {
            // Kembali ke login → video gelap + blur kembali
            loginBox.classList.remove("hidden");
            overlay.classList.remove("overlay-hidden");
            toggleBtn.textContent = "Lihat Video";

            // fade overlay in
            overlay.style.transition = "opacity 0.6s ease";
            overlay.style.opacity = "1";
        } else {
            // Lihat video → video jadi terang (overlay hilang)
            loginBox.classList.add("hidden");
            overlay.classList.add("overlay-hidden");
            toggleBtn.textContent = "Kembali ke Login";

            // fade overlay out
            overlay.style.transition = "opacity 0.6s ease";
            overlay.style.opacity = "0";
        }
    });

    // ================= ERROR ANIMATION =================
    const hasError = "{{ ($errors->any() || session('error')) ? 'yes' : 'no' }}";

    document.addEventListener("DOMContentLoaded", () => {
        if (hasError === "yes") {
            const loginPanel = document.getElementById("slider");
            if (loginPanel) {
                loginPanel.classList.add("animate-shake");
                setTimeout(() => loginPanel.classList.remove("animate-shake"), 600);
            }

            const err = document.getElementById("errorMessage");
            if (err) {
                err.style.opacity = "1";
                setTimeout(() => err.style.opacity = "0", 2000);
                setTimeout(() => err.remove(), 2600);
            }
        }
    });
</script>

</body>
</html>
