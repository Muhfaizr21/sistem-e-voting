@extends('layouts.admin')

@section('header', 'Hasil Voting Detail')

@section('content')
<div class="space-y-6">
    <!-- Statistics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-500 text-white mr-4">
                    👥
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pemilih</p>
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
                    <p class="text-sm font-medium text-gray-500">Total Suara</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalVotes }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-500 text-white mr-4">
                    📊
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Partisipasi</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $participationRate }}%</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-500 text-white mr-4">
                    ⏱️
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Belum Memilih</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalUsers - $totalVotes }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Winner Section -->
    @if($leadingCandidate)
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl shadow-lg text-white p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-bold mb-2">🎉 PEMENANG SEMENTARA</h3>
                <p class="text-lg font-semibold">{{ $leadingCandidate->name }}</p>
                <p class="text-emerald-100">{{ $leadingCandidate->class }}</p>
                <div class="mt-2 flex items-center">
                    <span class="text-3xl font-bold mr-2">{{ $leadingCandidate->vote_count }}</span>
                    <span class="text-emerald-100">suara</span>
                    <span class="mx-3">•</span>
                    <span class="text-emerald-100">{{ $leadingPercentage }}% dari total suara</span>
                </div>
            </div>
            <div class="text-6xl">🏆</div>
        </div>
    </div>
    @endif

    <!-- Charts and Results -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Results Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="mr-2">📊</span>
                        Hasil Voting Detail
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Peringkat
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kandidat
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Suara
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Persentase
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Progress
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($candidates as $index => $candidate)
                            <tr class="hover:bg-gray-50 transition-colors {{ $index === 0 ? 'bg-green-50' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($index === 0)
                                            <span class="text-2xl">🥇</span>
                                        @elseif($index === 1)
                                            <span class="text-2xl">🥈</span>
                                        @elseif($index === 2)
                                            <span class="text-2xl">🥉</span>
                                        @else
                                            <span class="text-lg font-bold text-gray-600">#{{ $index + 1 }}</span>
                                        @endif
                                    </div>
                                </td>
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
                                            <div class="text-xs text-gray-500">
                                                {{ $candidate->class }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-center">
                                        <span class="text-lg font-bold text-blue-600">{{ $candidate->vote_count }}</span>
                                        <p class="text-xs text-gray-500">suara</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-green-600">{{ $percentages[$candidate->id] }}%</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-32 bg-gray-200 rounded-full h-3">
                                        <div class="bg-green-500 h-3 rounded-full transition-all duration-500"
                                             style="width: {{ $percentages[$candidate->id] }}%"></div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Voting Statistics -->
        <div class="space-y-6">
            <!-- Participation Chart -->
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">📈 Partisipasi Voting</h4>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-green-600">Sudah Memilih</span>
                            <span class="font-semibold">{{ $totalVotes }} ({{ $participationRate }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-green-500 h-3 rounded-full" style="width: {{ $participationRate }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-red-600">Belum Memilih</span>
                            <span class="font-semibold">{{ $totalUsers - $totalVotes }} ({{ 100 - $participationRate }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-red-500 h-3 rounded-full" style="width: {{ 100 - $participationRate }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Voting Timeline -->
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">⏰ Timeline Voting</h4>
                <div class="space-y-3">
                    @php
                        $voteHours = $votes->groupBy(function($vote) {
                            return $vote->created_at->format('H:00');
                        })->map->count();
                    @endphp

                    @foreach($voteHours->sortKeys() as $hour => $count)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">Jam {{ $hour }}</span>
                            <span class="font-semibold">{{ $count }} suara</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full"
                                 style="width: {{ ($count / max($voteHours->max(), 1)) * 100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">⚡ Quick Actions</h4>
                <div class="space-y-3">
                    <a href="{{ route('admin.candidates') }}"
                       class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg flex items-center justify-center transition">
                        <span class="mr-2">👥</span> Kelola Kandidat
                    </a>
                    <button onclick="window.print()"
                            class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg flex items-center justify-center transition">
                        <span class="mr-2">🖨️</span> Print Laporan
                    </button>
                    <form action="{{ route('admin.reset.voting') }}" method="POST"
                          onsubmit="return confirm('⚠️ Yakin reset semua data voting? Tindakan ini tidak dapat dibatalkan!')">
                        @csrf
                        <button type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg flex items-center justify-center transition">
                            <span class="mr-2">🔄</span> Reset Voting
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Votes -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="p-6 border-b">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <span class="mr-2">🕒</span>
                Voting Terbaru
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Waktu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pemilih
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kandidat Dipilih
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kelas
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentVotes as $vote)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $vote->created_at->translatedFormat('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $vote->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $vote->user->nis }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-blue-600">{{ $vote->candidate->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $vote->user->kelas }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            <div class="text-4xl mb-2">😔</div>
                            Belum ada voting
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($recentVotes->count() > 0)
        <div class="p-4 border-t bg-gray-50">
            <div class="text-sm text-gray-600 text-center">
                Menampilkan {{ $recentVotes->count() }} voting terbaru dari total {{ $totalVotes }} suara
            </div>
        </div>
        @endif
    </div>
</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }

    body {
        background: white !important;
    }

    .bg-gray-50 {
        background: white !important;
    }
}
</style>
@endsection
