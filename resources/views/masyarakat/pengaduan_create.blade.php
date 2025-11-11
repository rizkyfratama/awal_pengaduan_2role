<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pengaduan Masyarakat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    
                    <h3 class="text-xl font-semibold mb-2">Form Pengaduan Masyarakat</h3>
                    <p class="text-gray-600 mb-6">Silakan isi formulir di bawah ini dengan lengkap dan jelas.</p>

                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="border rounded-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-blue-600">Data Pelapor</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_pelapor" class="block text-sm font-medium">Nama Lengkap *</label>
                                    <input type="text" name="nama_pelapor" id="nama_pelapor" 
                                           value="{{ old('nama_pelapor', auth()->user()->name) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    @error('nama_pelapor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="telepon_pelapor" class="block text-sm font-medium">Nomor Telepon *</label>
                                    <input type="text" name="telepon_pelapor" id="telepon_pelapor" 
                                           value="{{ old('telepon_pelapor') }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    @error('telepon_pelapor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="email_pelapor" class="block text-sm font-medium">Email (Opsional)</label>
                                    <input type="email" name="email_pelapor" id="email_pelapor" 
                                           value="{{ old('email_pelapor', auth()->user()->email) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>

                                <div>
                                    <label for="alamat_pelapor" class="block text-sm font-medium">Alamat (Opsional)</label>
                                    <input type="text" name="alamat_pelapor" id="alamat_pelapor" 
                                           value="{{ old('alamat_pelapor') }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                            </div>
                        </div>

                        <div class="border rounded-lg p-6 mb-6">
                            <h3 class="text-lg font-semibold mb-4 text-blue-600">Detail Pengaduan</h3>
                            
                            <div class="mb-4">
                                <label for="kategori_id" class="block text-sm font-medium">Kategori Pengaduan *</label>
                                <select name="kategori_id" id="kategori_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                    <option value="">Pilih kategori...</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label for="judul" class="block text-sm font-medium">Judul Pengaduan *</label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Ringkasan singkat pengaduan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="uraian" class="block text-sm font-medium">Uraian Pengaduan *</label>
                                <textarea name="uraian" id="uraian" rows="5" placeholder="Jelaskan detail pengaduan Anda dengan lengkap..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('uraian') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="lokasi_kejadian" class="block text-sm font-medium">Lokasi Kejadian *</label>
                                <input type="text" name="lokasi_kejadian" id="lokasi_kejadian" value="{{ old('lokasi_kejadian') }}" placeholder="Alamat atau lokasi spesifik kejadian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="foto" class="block text-sm font-medium">Foto Pendukung (Opsional)</label>
                                <input type="file" name="foto" id="foto" class="mt-1 block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100">
                                <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, Maksimal 5MB.</p>
                                @error('foto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded-lg mb-6" role="alert">
                            <p class="font-bold">Perhatian:</p>
                            <p class="text-sm">Semua informasi akan dijaga kerahasiaannya. Untuk kasus darurat, silakan hubungi hotline (0511) 3307-999 (tersedia 24 jam). Tim kami siap memberikan bantuan dan perlindungan.</p>
                        </div>

                        <div class="mt-6 text-right">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-500">
                                Kirim Pengaduan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>