<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👤 Profil Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- User Info -->
                    <div class="text-center mb-8">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full mx-auto flex items-center justify-center text-white text-2xl font-bold mb-4">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h3>
                        <p class="text-gray-600">NIS: {{ $user->nis }} | Kelas: {{ $user->kelas }}</p>
                    </div>

                    <!-- Voting Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <div class="text-3xl mb-2">
                                @if($user->has_voted)
                                    ✅
                                @else
                                    ⏳
                                @endif
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-1">Status Voting</h4>
                            <p class="text-gray-600">
                                @if($user->has_voted)
                                    Sudah Memilih
                                @else
                                    Belum Memilih
                                @endif
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <div class="text-3xl mb-2">📅</div>
                            <h4 class="font-semibold text-gray-800 mb-1">Bergabung</h4>
                            <p class="text-gray-600">{{ $user->created_at->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>

                    <!-- Voting History -->
                    @if($userVote)
                    <div class="border-t pt-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">📋 Riwayat Voting Anda</h4>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    @if($userVote->candidate->photo)
                                        <img src="{{ asset('storage/' . $userVote->candidate->photo) }}"
                                             alt="{{ $userVote->candidate->name }}"
                                             class="w-16 h-16 rounded-full object-cover border-2 border-green-500">
                                    @else
                                        <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center border-2 border-green-500">
                                            <span class="text-green-500 text-lg">👤</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm text-green-600">Anda memilih:</p>
                                        <p class="text-xl font-bold text-green-800">{{ $userVote->candidate->name }}</p>
                                        <p class="text-green-700">{{ $userVote->candidate->class }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-green-600">Waktu Voting:</p>
                                    <p class="font-semibold text-green-800">{{ $userVote->created_at->translatedFormat('d F Y') }}</p>
                                    <p class="text-green-700">{{ $userVote->created_at->format('H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="border-t pt-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">📋 Riwayat Voting</h4>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                            <div class="text-4xl mb-3">😴</div>
                            <p class="text-yellow-800 font-semibold mb-2">Anda belum melakukan voting</p>
                            <p class="text-yellow-700 mb-4">Yuk, ikut berpartisipasi dalam pemilihan ketua OSIS!</p>
                            <a href="{{ route('voting.candidates') }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition">
                                🗳️ Vote Sekarang
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="border-t pt-6 mt-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">⚡ Quick Actions</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('voting.candidates') }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center transition">
                                <div class="text-2xl mb-2">🗳️</div>
                                <p class="font-semibold">Voting</p>
                                <p class="text-sm opacity-90">Pilih kandidat</p>
                            </a>

                            <a href="{{ route('voting.results') }}"
                               class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center transition">
                                <div class="text-2xl mb-2">📊</div>
                                <p class="font-semibold">Hasil</p>
                                <p class="text-sm opacity-90">Lihat perkembangan</p>
                            </a>

                            <a href="{{ route('dashboard') }}"
                               class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center transition">
                                <div class="text-2xl mb-2">🏠</div>
                                <p class="font-semibold">Dashboard</p>
                                <p class="text-sm opacity-90">Kembali ke beranda</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
