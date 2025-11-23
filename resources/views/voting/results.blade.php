<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Hasil Pemilihan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm border p-6 text-center">
                    <div class="text-3xl font-bold text-blue-600">{{ $totalVotes }}</div>
                    <div class="text-gray-600">Total Suara</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border p-6 text-center">
                    <div class="text-3xl font-bold text-green-600">{{ $participationRate }}%</div>
                    <div class="text-gray-600">Tingkat Partisipasi</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm border p-6 text-center">
                    <div class="text-3xl font-bold text-purple-600">{{ $candidates->count() }}</div>
                    <div class="text-gray-600">Jumlah Kandidat</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">Hasil Pemilihan Sementara</h3>
                        <div class="flex items-center space-x-2">
                            @if($userHasVoted)
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    ✅ Anda sudah memilih
                                </span>
                            @else
                                <a href="{{ route('voting.candidates') }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                                    🗳️ Vote Sekarang
                                </a>
                            @endif
                        </div>
                    </div>

                    @if($candidates->isEmpty())
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">📝</div>
                            <h4 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Kandidat</h4>
                            <p class="text-gray-500">Pemilihan belum dimulai.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($candidates as $index => $candidate)
                            <div class="border rounded-lg p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        @if($index === 0)
                                            <span class="text-3xl">🥇</span>
                                        @elseif($index === 1)
                                            <span class="text-3xl">🥈</span>
                                        @elseif($index === 2)
                                            <span class="text-3xl">🥉</span>
                                        @else
                                            <span class="text-xl font-bold text-gray-400">#{{ $index + 1 }}</span>
                                        @endif

                                        <div class="flex items-center space-x-3">
                                            @if($candidate->photo)
                                                <img src="{{ asset('storage/' . $candidate->photo) }}"
                                                     alt="{{ $candidate->name }}"
                                                     class="w-12 h-12 rounded-full object-cover border">
                                            @else
                                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center border">
                                                    <span class="text-gray-500 text-xs">Foto</span>
                                                </div>
                                            @endif
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-800">{{ $candidate->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $candidate->class }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-blue-600">{{ $candidate->vote_count }}</div>
                                        <div class="text-sm text-gray-600">suara</div>
                                        <div class="text-sm font-semibold text-green-600">{{ $percentages[$candidate->id] }}%</div>
                                    </div>
                                </div>

                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="bg-gradient-to-r from-green-400 to-blue-500 h-4 rounded-full transition-all duration-1000"
                                         style="width: {{ $percentages[$candidate->id] }}%"></div>
                                </div>

                                @if($candidate->vision)
                                    <div class="mt-3 text-sm text-gray-600">
                                        <span class="font-semibold">Visi:</span> {{ Str::limit($candidate->vision, 100) }}
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>

                        <!-- Legend -->
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                            <h5 class="font-semibold text-gray-700 mb-2">Keterangan:</h5>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <span class="mr-2">🥇</span> Peringkat 1
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-2">🥈</span> Peringkat 2
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-2">🥉</span> Peringkat 3
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- User Action -->
            <div class="mt-6 text-center">
                @if(!$userHasVoted)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 max-w-2xl mx-auto">
                        <h4 class="text-lg font-semibold text-yellow-800 mb-2">💡 Anda belum memilih!</h4>
                        <p class="text-yellow-700 mb-4">Suara Anda penting untuk menentukan masa depan OSIS kita.</p>
                        <a href="{{ route('voting.candidates') }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg transition">
                            🗳️ Yuk, Vote Sekarang!
                        </a>
                    </div>
                @else
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6 max-w-2xl mx-auto">
                        <h4 class="text-lg font-semibold text-green-800 mb-2">✅ Terima kasih sudah berpartisipasi!</h4>
                        <p class="text-green-700">Suara Anda telah tercatat dan berkontribusi untuk kemajuan sekolah.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
