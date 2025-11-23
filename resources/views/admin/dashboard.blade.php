@extends('layouts.admin')

@section('header', 'Dashboard Administrator')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600 mr-4">
                    <span class="text-2xl">👥</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <p class="text-xs text-gray-500">Registered voters</p>
            </div>
        </div>

        <!-- Total Votes -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-green-50 text-green-600 mr-4">
                    <span class="text-2xl">🗳️</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Votes</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalVotes }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <p class="text-xs text-gray-500">Votes casted</p>
            </div>
        </div>

        <!-- Candidates -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-purple-50 text-purple-600 mr-4">
                    <span class="text-2xl">💼</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Kandidat</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $candidates->count() }}</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <p class="text-xs text-gray-500">Active candidates</p>
            </div>
        </div>

        <!-- Participation -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-orange-50 text-orange-600 mr-4">
                    <span class="text-2xl">📊</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Partisipasi</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $participationRate }}%</p>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-orange-500 h-2 rounded-full transition-all duration-1000"
                         style="width: {{ $participationRate }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.candidates') }}"
           class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300 hover:border-indigo-200">
            <div class="text-center">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">👥</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Kelola Kandidat</h3>
                <p class="text-sm text-gray-600">Tambah, edit, atau hapus kandidat pemilihan</p>
                <div class="mt-4 inline-flex items-center text-indigo-600 text-sm font-medium">
                    <span>Manage</span>
                    <span class="ml-1 group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.voting.results') }}"
           class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300 hover:border-green-200">
            <div class="text-center">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">📈</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Hasil Voting</h3>
                <p class="text-sm text-gray-600">Pantau perkembangan dan hasil pemilihan</p>
                <div class="mt-4 inline-flex items-center text-green-600 text-sm font-medium">
                    <span>View Results</span>
                    <span class="ml-1 group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.users') }}"
           class="group bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-all duration-300 hover:border-purple-200">
            <div class="text-center">
                <div class="text-4xl mb-4 group-hover:scale-110 transition-transform duration-300">👤</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Kelola User</h3>
                <p class="text-sm text-gray-600">Kelola data user dan peserta pemilihan</p>
                <div class="mt-4 inline-flex items-center text-purple-600 text-sm font-medium">
                    <span>Manage Users</span>
                    <span class="ml-1 group-hover:translate-x-1 transition-transform">→</span>
                </div>
            </div>
        </a>
    </div>

    <!-- Results Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <span class="mr-3">🏆</span>
                    Hasil Pemilihan Real-time
                </h3>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                    Live Update
                </span>
            </div>
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
                            Kelas
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Jumlah Suara
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Persentase
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($candidates as $index => $candidate)
                    <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $index === 0 ? 'bg-gradient-to-r from-yellow-50 to-transparent' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($index === 0)
                                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <span class="text-yellow-600 font-bold text-lg">🥇</span>
                                    </div>
                                @elseif($index === 1)
                                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                        <span class="text-gray-600 font-bold text-lg">🥈</span>
                                    </div>
                                @elseif($index === 2)
                                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                        <span class="text-orange-600 font-bold text-lg">🥉</span>
                                    </div>
                                @else
                                    <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center">
                                        <span class="text-blue-600 font-bold text-sm">#{{ $index + 1 }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    @if($candidate->photo)
                                        <img class="h-12 w-12 rounded-full object-cover border-2 border-gray-200"
                                             src="{{ asset('storage/' . $candidate->photo) }}"
                                             alt="{{ $candidate->name }}">
                                    @else
                                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center border-2 border-gray-200">
                                            <span class="text-gray-500 text-lg">👤</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $candidate->name }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ Str::limit($candidate->vision, 30) }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $candidate->class }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-center">
                                <span class="text-2xl font-bold text-gray-900">{{ $candidate->votes_count }}</span>
                                <p class="text-xs text-gray-500">suara</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $total = $candidates->sum('votes_count');
                                $percentage = $total > 0 ? round(($candidate->votes_count / $total) * 100, 1) : 0;
                            @endphp
                            <div class="flex items-center space-x-3">
                                <div class="flex-1">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-gradient-to-r from-green-400 to-blue-500 h-2.5 rounded-full transition-all duration-1000"
                                             style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                                <span class="text-sm font-bold text-gray-700 w-12">{{ $percentage }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($candidates->isEmpty())
        <div class="text-center py-12">
            <div class="text-6xl mb-4">📝</div>
            <h4 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Kandidat</h4>
            <p class="text-gray-500 mb-4">Mulai dengan menambahkan kandidat pertama.</p>
            <a href="{{ route('admin.candidates') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-medium transition-colors inline-flex items-center">
                <span class="mr-2">➕</span> Tambah Kandidat Pertama
            </a>
        </div>
        @endif
    </div>
</div>

<style>
    .gradient-border {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
</style>
@endsection
