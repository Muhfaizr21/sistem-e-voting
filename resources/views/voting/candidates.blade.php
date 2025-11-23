<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Kandidat Ketua OSIS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-center">PILIH KANDIDAT FAVORIT MU!</h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach($candidates as $candidate)
                        <div class="border rounded-lg p-6 shadow-md hover:shadow-lg transition">
                            <div class="text-center mb-4">
                                @if($candidate->photo)
                                    <img src="{{ asset('storage/' . $candidate->photo) }}"
                                         alt="{{ $candidate->name }}"
                                         class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-blue-500">
                                @else
                                    <div class="w-32 h-32 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">No Photo</span>
                                    </div>
                                @endif
                            </div>

                            <h4 class="text-xl font-bold text-center text-blue-600">{{ $candidate->name }}</h4>
                            <p class="text-center text-gray-600 mb-4">Kelas: {{ $candidate->class }}</p>

                            <div class="mb-4">
                                <h5 class="font-semibold text-green-600">Visi:</h5>
                                <p class="text-sm text-gray-700">{{ $candidate->vision }}</p>
                            </div>

                            <div class="mb-4">
                                <h5 class="font-semibold text-green-600">Misi:</h5>
                                <p class="text-sm text-gray-700">{{ $candidate->mission }}</p>
                            </div>

                            <form action="{{ route('voting.vote', $candidate->id) }}" method="POST" class="text-center">
                                @csrf
                                <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg transition"
                                        onclick="return confirm('Yakin memilih {{ $candidate->name }}?')">
                                    🗳️ PILIH
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
