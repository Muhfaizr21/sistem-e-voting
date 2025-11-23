@extends('layouts.admin')

@section('header', 'Dashboard Administrator')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-500 text-white mr-4">
                    👥
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 text-white mr-4">
                    🗳️
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Votes</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalVotes }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-500 text-white mr-4">
                    💼
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Kandidat</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $candidates->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-500 text-white mr-4">
                    📊
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Partisipasi</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $participationRate }}%
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.candidates') }}"
           class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow group">
            <div class="text-center">
                <div class="text-3xl mb-3 group-hover:scale-110 transition-transform">👥</div>
                <h3 class="font-semibold text-gray-800 mb-2">Kelola Kandidat</h3>
                <p class="text-sm text-gray-600">Tambah, edit, atau hapus kandidat</p>
            </div>
        </a>

        <a href="{{ route('voting.results') }}"
           class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow group">
            <div class="text-center">
                <div class="text-3xl mb-3 group-hover:scale-110 transition-transform">📈</div>
                <h3 class="font-semibold text-gray-800 mb-2">Lihat Hasil</h3>
                <p class="text-sm text-gray-600">Pantau perkembangan pemilihan</p>
            </div>
        </a>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="text-center">
                <div class="text-3xl mb-3">⚙️</div>
                <h3 class="font-semibold text-gray-800 mb-2">System Info</h3>
                <p class="text-sm text-gray-600">Laravel {{ app()->version() }}</p>
                <p class="text-xs text-gray-500 mt-1">PHP {{ PHP_VERSION }}</p>
            </div>
        </div>
    </div>

    <!-- Results Table -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="p-6 border-b">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <span class="mr-2">📊</span>
                Hasil Pemilihan Real-time
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kandidat
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kelas
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah Suara
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Persentase
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($candidates as $candidate)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($candidate->photo)
                                        <img class="h-10 w-10 rounded-full object-cover border"
                                             src="{{ asset('storage/' . $candidate->photo) }}"
                                             alt="{{ $candidate->name }}"
                                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiByeD0iMjAiIGZpbGw9IiNGM0Y0RjYiLz4KPHBhdGggZD0iTTIwIDIwQzI0LjQxODMgMjAgMjggMTYuNDE4MyAyOCAxMkMyOCA3LjU4MTcyIDI0LjQxODMgNCAyMCA0QzE1LjU4MTcgNCAxMiA3LjU4MTcyIDEyIDEyQzEyIDE2LjQxODMgMTUuNTgxNyAyMCAyMCAyMFpNMjAgMjRDMTQuNDcgMjQgMTAgMjguNDcgMTAgMzRIMzBDMzAgMjguNDcgMjUuNTMgMjQgMjAgMjRaIiBmaWxsPSIjOUNBMEFGIi8+Cjwvc3ZnPgo='">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center border">
                                            <span class="text-gray-500 text-xs">Foto</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $candidate->name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $candidate->class }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                {{ $candidate->votes_count }} suara
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $total = $candidates->sum('votes_count');
                                $percentage = $total > 0 ? round(($candidate->votes_count / $total) * 100, 1) : 0;
                            @endphp
                            <div class="flex items-center">
                                <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                    <div class="bg-green-500 h-2 rounded-full transition-all duration-500"
                                         style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ $percentage }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($candidates->isEmpty())
        <div class="text-center py-12">
            <div class="text-4xl mb-4">📝</div>
            <h4 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Kandidat</h4>
            <p class="text-gray-500 mb-4">Mulai dengan menambahkan kandidat pertama.</p>
            <a href="{{ route('admin.candidates') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg inline-flex items-center">
                <span class="mr-2">➕</span> Tambah Kandidat
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
