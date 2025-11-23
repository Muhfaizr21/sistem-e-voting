<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📚 Panduan Voting
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Panduan Pemilihan Ketua OSIS</h3>
                        <p class="text-gray-600">Ikuti langkah-langkah berikut untuk melakukan voting dengan benar</p>
                    </div>

                    <!-- Steps -->
                    <div class="space-y-8">
                        <!-- Step 1 -->
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                1
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-800 mb-2">Login ke Sistem</h4>
                                <p class="text-gray-600">Gunakan akun yang telah didaftarkan oleh administrator. Pastikan Anda login dengan benar.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                2
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-800 mb-2">Baca Profil Kandidat</h4>
                                <p class="text-gray-600">Pelajari visi dan misi setiap kandidat dengan seksama sebelum memilih.</p>
                                <ul class="mt-2 text-gray-600 list-disc list-inside space-y-1">
                                    <li>Baca visi dan misi setiap kandidat</li>
                                    <li>Perhatikan program kerja yang ditawarkan</li>
                                    <li>Pertimbangkan kredibilitas dan kemampuan</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                3
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-800 mb-2">Pilih Kandidat</h4>
                                <p class="text-gray-600">Klik tombol "PILIH KANDIDAT" pada kandidat pilihan Anda.</p>
                                <div class="mt-3 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <p class="text-yellow-800 font-semibold">⚠️ Peringatan Penting:</p>
                                    <p class="text-yellow-700">Pilihan tidak dapat diubah setelah dikirim. Pastikan Anda yakin dengan pilihan!</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                4
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-800 mb-2">Konfirmasi Voting</h4>
                                <p class="text-gray-600">Setelah memilih, Anda akan melihat halaman konfirmasi dan tidak dapat voting lagi.</p>
                            </div>
                        </div>

                        <!-- Step 5 -->
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                5
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-800 mb-2">Pantau Hasil</h4>
                                <p class="text-gray-600">Anda dapat melihat hasil pemilihan sementara di menu "Hasil Pemilihan".</p>
                            </div>
                        </div>
                    </div>

                    <!-- Important Notes -->
                    <div class="mt-8 p-6 bg-blue-50 border border-blue-200 rounded-lg">
                        <h4 class="text-lg font-semibold text-blue-800 mb-3">📋 Ketentuan Penting</h4>
                        <ul class="text-blue-700 space-y-2">
                            <li class="flex items-start">
                                <span class="mr-2">🔒</span>
                                <span>Setiap user hanya dapat memilih <strong>satu kali</strong> saja</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">🚫</span>
                                <span>Pilihan <strong>tidak dapat diubah</strong> setelah dikirim</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">🤫</span>
                                <span>Pilihan Anda bersifat <strong>rahasia</strong> dan aman</span>
                            </li>
                            <li class="flex items-start">
                                <span class="mr-2">⏰</span>
                                <span>Voting hanya dapat dilakukan dalam periode yang ditentukan</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                        @if(Auth::user()->has_voted)
                            <a href="{{ route('voting.results') }}"
                               class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition text-center">
                                📊 Lihat Hasil Pemilihan
                            </a>
                        @else
                            <a href="{{ route('voting.candidates') }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition text-center">
                                🗳️ Mulai Voting Sekarang
                            </a>
                        @endif
                        <a href="{{ route('voting.profile') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition text-center">
                            👤 Lihat Profil Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
