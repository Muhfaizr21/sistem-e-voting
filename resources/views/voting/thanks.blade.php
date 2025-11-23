<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Terima Kasih
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <div class="text-green-500 text-6xl mb-4">✅</div>
                    <h3 class="text-3xl font-bold text-green-600 mb-4">SUARA ANDA TELAH TERKIRIM!</h3>
                    <p class="text-lg text-gray-700 mb-6">Terima kasih telah berpartisipasi dalam Pemilihan Ketua OSIS</p>
                    <a href="{{ route('voting.results') }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg">
                        Lihat Hasil Sementara
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
