<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kontak Dinas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    
                    <div class="p-6 md:p-8">
                        <h3 class="text-xl font-semibold mb-4">Lokasi Kami</h3>
                        <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden border">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.136012975101!2d114.5931293153344!3d-3.315354997576204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de4211158a202a5%3A0x6c6c7d9e11c2a1c2!2sDinas%20Pemberdayaan%20Perempuan%20dan%20Perlindungan%20Anak%20Kota%20Banjarmasin!5e0!3m2!1sid!2sid!4v1678168918228!5m2!1sid!2sid" 
                                width="100%" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                    <div class="p-6 md:p-8">
                        <h3 class="text-xl font-semibold mb-4">Informasi Kontak</h3>
                        <p class="text-gray-600 mb-6">
                            Hubungi kami melalui alamat atau media sosial di bawah ini jika Anda memerlukan bantuan atau informasi lebih lanjut.
                        </p>
                        
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg class="flex-shrink-0 h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-medium">Alamat</h4>
                                    <p class="text-gray-600">Jl. Brig Jend. Hasan Basri No.20, Pangeran, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70124</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="flex-shrink-0 h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.211-.992-.55-1.33L19.5 17.55a2.25 2.25 0 01-3.182 0l-1.26-1.26a2.25 2.25 0 00-3.182 0l-1.26 1.26a2.25 2.25 0 01-3.182 0l-1.379-1.379a2.25 2.25 0 010-3.182l1.26-1.26a2.25 2.25 0 000-3.182l-1.26-1.26a2.25 2.25 0 010-3.182L6.117 2.8a2.25 2.25 0 00-1.33-.55H3.375a2.25 2.25 0 00-2.25 2.25v1.372z" />
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-medium">Telepon</h4>
                                    <p class="text-gray-600">(0511) 3300539</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="flex-shrink-0 h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-medium">Email</h4>
                                    <p class="text-gray-600">dp3abjm@gmail.com</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg class="flex-shrink-0 h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                                <div class="ml-3">
                                    <h4 class="font-medium">Instagram</h4>
                                    <a href="https://www.instagram.com/dp3a_banjarmasin/" target="_blank" class="text-gray-600 hover:text-blue-600">@dp3a_banjarmasin</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>