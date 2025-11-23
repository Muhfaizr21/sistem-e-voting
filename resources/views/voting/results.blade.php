<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hasil Pemilihan Sementara
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-center mb-8">HASIL PEMILIHAN SEMENTARA</h3>

                    <div class="space-y-6">
                        @foreach($candidates as $candidate)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="text-xl font-bold text-blue-600">{{ $candidate->name }}</h4>
                                <span class="bg-blue-500 text-white px-3 py-1 rounded-full">
                                    {{ $candidate->vote_count }} Suara
                                </span>
                            </div>
                            <p class="text-gray-600 mb-2">Kelas: {{ $candidate->class }}</p>
                            <div class="w-full bg-gray-200 rounded-full h-4">
                                <div class="bg-green-500 h-4 rounded-full"
                                     style="width: {{ $candidates->sum('vote_count') > 0 ? ($candidate->vote_count / $candidates->sum('vote_count')) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-lg font-semibold">
                            Total Suara: {{ $candidates->sum('vote_count') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
