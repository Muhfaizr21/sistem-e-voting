@extends('layouts.admin')

@section('header', 'Hasil Voting Detail')

@section('content')
<div class="space-y-6">
    <!-- Statistics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600 mr-4">
                    <span class="text-2xl">👥</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pemilih</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-green-50 text-green-600 mr-4">
                    <span class="text-2xl">🗳️</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Suara</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalVotes }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-purple-50 text-purple-600 mr-4">
                    <span class="text-2xl">📊</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Partisipasi</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $participationRate }}%</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-orange-50 text-orange-600 mr-4">
                    <span class="text-2xl">⏱️</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Belum Memilih</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers - $totalVotes }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Winner Section -->
    @if($leadingCandidate && $leadingCandidate->vote_count > 0)
    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl shadow-lg text-white p-8">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-3xl font-bold mb-3">🎉 PEMENANG SEMENTARA</h3>
                <p class="text-2xl font-semibold mb-2">{{ $leadingCandidate->name }}</p>
                <p class="text-yellow-100 text-lg mb-4">{{ $leadingCandidate->class }}</p>
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <span class="text-4xl font-bold block">{{ $leadingCandidate->vote_count }}</span>
                        <span class="text-yellow-100">suara</span>
                    </div>
                    <div class="h-12 w-px bg-yellow-300"></div>
                    <div class="text-center">
                        <span class="text-4xl font-bold block">{{ $leadingPercentage }}%</span>
                        <span class="text-yellow-100">dari total</span>
                    </div>
                </div>
            </div>
            <div class="text-8xl animate-bounce">🏆</div>
        </div>
    </div>
    @endif

    <!-- Charts and Results -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Results Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="mr-3">📊</span>
                        Hasil Voting Detail
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Peringkat
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Kandidat
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Suara
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Persentase
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Progress
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($candidates as $index => $candidate)
                            <tr class="hover:bg-gray-50 transition-colors {{ $index === 0 ? 'bg-gradient-to-r from-yellow-50 to-transparent' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($index === 0)
                                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center shadow-lg">
                                                <span class="text-yellow-600 font-bold text-lg">🥇</span>
                                            </div>
                                        @elseif($index === 1)
                                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center shadow-lg">
                                                <span class="text-gray-600 font-bold text-lg">🥈</span>
                                            </div>
                                        @elseif($index === 2)
                                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center shadow-lg">
                                                <span class="text-orange-600 font-bold text-lg">🥉</span>
                                            </div>
                                        @else
                                            <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center shadow">
                                                <span class="text-blue-600 font-bold text-sm">#{{ $index + 1 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            @if($candidate->photo)
                                                <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-200 shadow"
                                                     src="{{ asset('storage/' . $candidate->photo) }}"
                                                     alt="{{ $candidate->name }}">
                                            @else
                                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center border-2 border-gray-200 shadow">
                                                    <span class="text-gray-500 text-lg">👤</span>
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
                                        <span class="text-2xl font-bold text-blue-600">{{ $candidate->vote_count }}</span>
                                        <p class="text-xs text-gray-500">suara</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-lg font-bold text-green-600">{{ $percentages[$candidate->id] }}%</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-32 bg-gray-200 rounded-full h-3 shadow-inner">
                                        <div class="bg-gradient-to-r from-green-400 to-blue-500 h-3 rounded-full transition-all duration-1000 shadow"
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
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="mr-2">📈</span>
                    Partisipasi Voting
                </h4>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-green-600 font-medium">Sudah Memilih</span>
                            <span class="font-semibold">{{ $totalVotes }} ({{ $participationRate }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 shadow-inner">
                            <div class="bg-green-500 h-3 rounded-full shadow" style="width: {{ $participationRate }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-red-600 font-medium">Belum Memilih</span>
                            <span class="font-semibold">{{ $totalUsers - $totalVotes }} ({{ 100 - $participationRate }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3 shadow-inner">
                            <div class="bg-red-500 h-3 rounded-full shadow" style="width: {{ 100 - $participationRate }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <span class="mr-2">⚡</span>
                    Quick Actions
                </h4>
                <div class="space-y-3">
                    <a href="{{ route('admin.candidates') }}"
                       class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-xl font-medium transition-colors flex items-center justify-center shadow hover:shadow-lg">
                        <span class="mr-2">👥</span> Kelola Kandidat
                    </a>
                    <button onclick="window.print()"
                            class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-xl font-medium transition-colors flex items-center justify-center shadow hover:shadow-lg">
                        <span class="mr-2">🖨️</span> Print Laporan
                    </button>
                    <form action="{{ route('admin.reset.voting') }}" method="POST"
                          onsubmit="return confirm('⚠️ Yakin reset semua data voting? Tindakan ini tidak dapat dibatalkan!')">
                        @csrf
                        <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-xl font-medium transition-colors flex items-center justify-center shadow hover:shadow-lg">
                            <span class="mr-2">🔄</span> Reset Voting
                        </button>
                    </form>
                </div>
            </div>

            <!-- System Info -->
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-lg text-white p-6">
                <h4 class="text-lg font-semibold mb-3">🏆 Top Performers</h4>
                <div class="space-y-3">
                    @foreach($candidates->take(3) as $index => $candidate)
                    <div class="flex items-center justify-between bg-white bg-opacity-20 rounded-lg p-3">
                        <div class="flex items-center">
                            @if($index === 0)
                                <span class="text-xl mr-2">🥇</span>
                            @elseif($index === 1)
                                <span class="text-xl mr-2">🥈</span>
                            @else
                                <span class="text-xl mr-2">🥉</span>
                            @endif
                            <span class="font-medium">{{ $candidate->name }}</span>
                        </div>
                        <span class="font-bold">{{ $candidate->vote_count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Votes -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <span class="mr-3">🕒</span>
                Voting Terbaru
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Waktu
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Pemilih
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Kandidat Dipilih
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Kelas
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($recentVotes as $vote)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                {{ $vote->created_at->translatedFormat('d/m H:i') }}
                            </div>
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
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                                {{ $vote->user->kelas }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="text-4xl mb-3">😔</div>
                            <p class="text-lg">Belum ada voting</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($recentVotes->count() > 0)
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
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

    .shadow-sm, .shadow-lg {
        box-shadow: none !important;
    }

    .border {
        border: 1px solid #e5e7eb !important;
    }
}
</style>
@endsection
