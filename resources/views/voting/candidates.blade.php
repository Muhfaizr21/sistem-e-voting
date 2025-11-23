<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🗳️ Pemilihan Ketua OSIS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">PILIH KANDIDAT FAVORIT MU!</h3>
                        <p class="text-gray-600">Pilih salah satu kandidat di bawah ini. Pilihanmu rahasia dan tidak dapat diubah!</p>
                    </div>

                    @if($candidates->isEmpty())
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">😔</div>
                            <h4 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Kandidat</h4>
                            <p class="text-gray-500">Silakan hubungi administrator untuk menambahkan kandidat.</p>
                        </div>
                    @else
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($candidates as $candidate)
                            <div class="border-2 border-gray-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-300">
                                <div class="text-center mb-4">
                                    @if($candidate->photo)
                                        <img src="{{ asset('storage/' . $candidate->photo) }}"
                                             alt="{{ $candidate->name }}"
                                             class="w-28 h-28 rounded-full mx-auto object-cover border-4 border-blue-500 shadow-md"
                                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTEyIiBoZWlnaHQ9IjExMiIgdmlld0JveD0iMCAwIDExMiAxMTIiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIxMTIiIGhlaWdodD0iMTEyIiByeD0iNTYiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTU2IDU2QzY2LjYwODcgNTYgNzUgNDcuNjA4NyA3NSAzN0M3NSAyNi4zOTEzIDY2LjYwODcgMTggNTYgMThDNDUuMzkxMyAxOCAzNyAyNi4zOTEzIDM3IDM3QzM3IDQ3LjYwODcgNDUuMzkxMyA1NiA1NiA1NlpNNTYgNjZDNDA1IDY2IDM3IDg1LjQ3IDM3IDk1SDEwNEMxMDQgODUuNDcgODcuNTMgNjYgNTYgNjZaIiBmaWxsPSIjOUNBMEFGIi8+Cjwvc3ZnPgo='">
                                    @else
                                        <div class="w-28 h-28 rounded-full mx-auto bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center border-4 border-blue-300 shadow-md">
                                            <span class="text-blue-500 text-4xl">👤</span>
                                        </div>
                                    @endif
                                </div>

                                <h4 class="text-xl font-bold text-center text-blue-600 mb-1">{{ $candidate->name }}</h4>
                                <p class="text-center text-gray-600 mb-4 text-sm bg-blue-50 py-1 rounded-full">Kelas: {{ $candidate->class }}</p>

                                <div class="space-y-3 mb-4">
                                    <div>
                                        <h5 class="font-semibold text-green-600 flex items-center text-sm">
                                            <span class="mr-1">🎯</span> Visi:
                                        </h5>
                                        <p class="text-sm text-gray-700 line-clamp-2">{{ Str::limit($candidate->vision, 100) }}</p>
                                    </div>

                                    <div>
                                        <h5 class="font-semibold text-green-600 flex items-center text-sm">
                                            <span class="mr-1">📋</span> Misi:
                                        </h5>
                                        <p class="text-sm text-gray-700 line-clamp-3">{{ Str::limit($candidate->mission, 120) }}</p>
                                    </div>
                                </div>

                                <form action="{{ route('voting.vote', $candidate->id) }}" method="POST" class="text-center">
                                    @csrf
                                    <button type="submit"
                                            class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg w-full"
                                            onclick="return confirm('Apakah Anda yakin memilih {{ $candidate->name }}? Pilihan tidak dapat diubah!')">
                                        <span class="flex items-center justify-center">
                                            🗳️ PILIH KANDIDAT
                                        </span>
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Info Section -->
                    <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <h4 class="font-semibold text-blue-800 mb-2">📝 Petunjuk Pemilihan:</h4>
                        <ul class="text-sm text-blue-700 list-disc list-inside space-y-1">
                            <li>Pilih salah satu kandidat yang menurut Anda paling capable</li>
                            <li>Pilihan Anda bersifat rahasia dan aman</li>
                            <li>Setelah memilih, Anda tidak dapat mengubah pilihan</li>
                            <li>Hasil pemilihan dapat dilihat di menu "Hasil Pemilihan"</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
</x-app-layout>
