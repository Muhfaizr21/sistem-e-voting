<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🏠 Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="p-8">
                    <div class="flex flex-col lg:flex-row items-center justify-between">
                        <div class="text-center lg:text-left mb-6 lg:mb-0">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">Halo, {{ Auth::user()->name }}! 👋</h1>
                            <p class="text-gray-600 text-lg mb-4">Selamat datang di sistem pemilihan ketua OSIS</p>
                            <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
                                <div class="bg-blue-50 px-4 py-2 rounded-lg border border-blue-200">
                                    <p class="text-sm text-blue-600">NIS</p>
                                    <p class="font-semibold text-blue-800">{{ Auth::user()->nis ?? '-' }}</p>
                                </div>
                                <div class="bg-green-50 px-4 py-2 rounded-lg border border-green-200">
                                    <p class="text-sm text-green-600">Kelas</p>
                                    <p class="font-semibold text-green-800">{{ Auth::user()->kelas ?? '-' }}</p>
                                </div>
                                <div class="bg-purple-50 px-4 py-2 rounded-lg border border-purple-200">
                                    <p class="text-sm text-purple-600">Status</p>
                                    <p class="font-semibold text-purple-800">
                                        @if(Auth::user()->has_voted)
                                            <span class="text-green-600">✅ Sudah Voting</span>
                                        @else
                                            <span class="text-orange-600">⏳ Belum Voting</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="text-6xl lg:text-8xl">
                            🎓
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @if(!Auth::user()->has_voted)
                <a href="{{ route('voting.candidates') }}"
                   class="group bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-center">
                        <div class="text-4xl mb-4 group-hover:scale-110 transition-transform">🗳️</div>
                        <h3 class="text-xl font-bold mb-2">Voting Sekarang</h3>
                        <p class="text-green-100 text-sm">Pilih kandidat ketua OSIS favoritmu</p>
                        <div class="mt-4 inline-flex items-center text-green-100 text-sm font-medium">
                            <span>Mulai Voting</span>
                            <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </div>
                </a>
                @else
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="text-center">
                        <div class="text-4xl mb-4">✅</div>
                        <h3 class="text-xl font-bold mb-2">Sudah Voting</h3>
                        <p class="text-green-100 text-sm">Terima kasih sudah berpartisipasi</p>
                    </div>
                </div>
                @endif

                <a href="{{ route('voting.results') }}"
                   class="group bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-center">
                        <div class="text-4xl mb-4 group-hover:scale-110 transition-transform">📊</div>
                        <h3 class="text-xl font-bold mb-2">Lihat Hasil</h3>
                        <p class="text-blue-100 text-sm">Pantau perkembangan pemilihan</p>
                        <div class="mt-4 inline-flex items-center text-blue-100 text-sm font-medium">
                            <span>Lihat Hasil</span>
                            <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('voting.profile') }}"
                   class="group bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-center">
                        <div class="text-4xl mb-4 group-hover:scale-110 transition-transform">👤</div>
                        <h3 class="text-xl font-bold mb-2">Profil Saya</h3>
                        <p class="text-purple-100 text-sm">Lihat data dan riwayat voting</p>
                        <div class="mt-4 inline-flex items-center text-purple-100 text-sm font-medium">
                            <span>Lihat Profil</span>
                            <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('voting.instructions') }}"
                   class="group bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl shadow-lg p-6 text-white hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-center">
                        <div class="text-4xl mb-4 group-hover:scale-110 transition-transform">📚</div>
                        <h3 class="text-xl font-bold mb-2">Panduan</h3>
                        <p class="text-orange-100 text-sm">Pelajari cara menggunakan sistem</p>
                        <div class="mt-4 inline-flex items-center text-orange-100 text-sm font-medium">
                            <span>Baca Panduan</span>
                            <span class="ml-2 group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Voting Status -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Voting Information -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="mr-3">ℹ️</span>
                        Informasi Voting
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-center">
                                <span class="text-2xl mr-3">📅</span>
                                <div>
                                    <p class="font-semibold text-blue-800">Periode Voting</p>
                                    <p class="text-blue-600 text-sm">Berlangsung sekarang</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex items-center">
                                <span class="text-2xl mr-3">✅</span>
                                <div>
                                    <p class="font-semibold text-green-800">Status Anda</p>
                                    <p class="text-green-600 text-sm">
                                        @if(Auth::user()->has_voted)
                                            <span class="font-bold">Sudah melakukan voting</span>
                                        @else
                                            <span class="font-bold">Belum melakukan voting</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-purple-50 rounded-lg border border-purple-200">
                            <div class="flex items-center">
                                <span class="text-2xl mr-3">🔒</span>
                                <div>
                                    <p class="font-semibold text-purple-800">Keamanan</p>
                                    <p class="text-purple-600 text-sm">Pilihan Anda rahasia dan aman</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!Auth::user()->has_voted)
                    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-center">
                            <span class="text-2xl mr-3">💡</span>
                            <div>
                                <p class="font-semibold text-yellow-800">Penting!</p>
                                <p class="text-yellow-700 text-sm">Anda hanya dapat memilih sekali dan tidak dapat mengubah pilihan setelahnya.</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <span class="mr-3">📈</span>
                        Statistik Cepat
                    </h3>

                    <div class="space-y-4">
                        @php
                            $totalUsers = \App\Models\User::count();
                            $totalVotes = \App\Models\Vote::count();
                            $participationRate = $totalUsers > 0 ? round(($totalVotes / $totalUsers) * 100, 1) : 0;
                            $candidatesCount = \App\Models\Candidate::count();
                        @endphp

                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                                <div class="text-2xl font-bold text-indigo-600">{{ $candidatesCount }}</div>
                                <p class="text-indigo-700 text-sm">Kandidat</p>
                            </div>
                            <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
                                <div class="text-2xl font-bold text-green-600">{{ $totalVotes }}</div>
                                <p class="text-green-700 text-sm">Total Suara</p>
                            </div>
                        </div>

                        <!-- Participation Progress -->
                        <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="font-medium text-blue-700">Tingkat Partisipasi</span>
                                <span class="font-bold text-blue-800">{{ $participationRate }}%</span>
                            </div>
                            <div class="w-full bg-blue-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full transition-all duration-1000"
                                     style="width: {{ $participationRate }}%"></div>
                            </div>
                            <p class="text-xs text-blue-600 mt-2">
                                {{ $totalVotes }} dari {{ $totalUsers }} user sudah voting
                            </p>
                        </div>

                        <!-- Call to Action -->
                        @if(!Auth::user()->has_voted)
                        <div class="text-center mt-6">
                            <a href="{{ route('voting.candidates') }}"
                               class="inline-flex items-center bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-3 rounded-xl font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <span class="mr-2 text-lg">🗳️</span>
                                VOTE SEKARANG
                            </a>
                        </div>
                        @else
                        <div class="text-center mt-6">
                            <div class="bg-green-100 border border-green-300 rounded-xl p-4">
                                <span class="text-green-600 font-bold text-lg">✅ Terima kasih sudah berpartisipasi!</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Bottom Info -->
            <div class="mt-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg text-white p-8">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <div class="text-center lg:text-left mb-6 lg:mb-0">
                        <h3 class="text-2xl font-bold mb-2">🎓 Pemilihan Ketua OSIS</h3>
                        <p class="text-indigo-100 text-lg">Mari bersama membangun OSIS yang lebih baik!</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('voting.instructions') }}"
                           class="bg-white text-indigo-600 px-6 py-2 rounded-lg font-medium hover:bg-indigo-50 transition-colors">
                            📚 Panduan
                        </a>
                        <a href="{{ route('voting.results') }}"
                           class="bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-800 transition-colors border border-indigo-400">
                            📊 Lihat Hasil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
