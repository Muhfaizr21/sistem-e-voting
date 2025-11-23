<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Terima Kasih
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-center">
                    <div class="text-green-500 text-6xl mb-6">✅</div>
                    <h3 class="text-3xl font-bold text-green-600 mb-4">SUARA ANDA TELAH TERKIRIM!</h3>

                    @if($userVote)
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6 max-w-md mx-auto">
                            <p class="text-lg text-green-800 mb-2">Anda memilih:</p>
                            <p class="text-xl font-bold text-green-900">{{ $userVote->candidate->name }}</p>
                            <p class="text-green-700">{{ $userVote->candidate->class }}</p>
                            <p class="text-sm text-green-600 mt-2">Waktu: {{ $userVote->created_at->translatedFormat('d F Y H:i') }}</p>
                        </div>
                    @endif

                    <p class="text-lg text-gray-700 mb-8">Terima kasih telah berpartisipasi dalam Pemilihan Ketua OSIS. Suara Anda sangat berharga untuk kemajuan sekolah.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto">
                        <a href="{{ route('voting.results') }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition flex items-center justify-center">
                            <span class="mr-2">📊</span> Lihat Hasil Sementara
                        </a>
                        <a href="{{ route('voting.profile') }}"
                           class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition flex items-center justify-center">
                            <span class="mr-2">👤</span> Lihat Profil Saya
                        </a>
                    </div>

                    <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg max-w-md mx-auto">
                        <p class="text-sm text-yellow-800">
                            <span class="font-bold">⚠️ Ingat:</span> Anda tidak dapat mengubah pilihan yang sudah dibuat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
