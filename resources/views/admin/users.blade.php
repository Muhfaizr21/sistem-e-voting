@extends('layouts.admin')

@section('header', 'Manajemen User')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600 mr-4">
                    <span class="text-2xl">👥</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total User</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $users->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Already Voted -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-green-50 text-green-600 mr-4">
                    <span class="text-2xl">✅</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Sudah Voting</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $users->where('has_voted', true)->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Not Voted -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-orange-50 text-orange-600 mr-4">
                    <span class="text-2xl">⏳</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Belum Voting</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $users->where('has_voted', false)->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Participation Rate -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-purple-50 text-purple-600 mr-4">
                    <span class="text-2xl">📊</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Partisipasi</p>
                    <p class="text-3xl font-bold text-gray-900">
                        {{ $users->count() > 0 ? round(($users->where('has_voted', true)->count() / $users->count()) * 100, 1) : 0 }}%
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- User Management -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <span class="mr-3">👤</span>
                    Daftar User
                    <span class="ml-3 bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $users->count() }} User
                    </span>
                </h3>
                <div class="flex items-center space-x-3">
                    <!-- Filter Buttons -->
                    <div class="flex bg-gray-100 rounded-lg p-1">
                        <button onclick="filterUsers('all')" class="filter-btn px-3 py-1 rounded-md text-sm font-medium transition-all active" data-filter="all">
                            Semua
                        </button>
                        <button onclick="filterUsers('voted')" class="filter-btn px-3 py-1 rounded-md text-sm font-medium transition-all" data-filter="voted">
                            Sudah Vote
                        </button>
                        <button onclick="filterUsers('not-voted')" class="filter-btn px-3 py-1 rounded-md text-sm font-medium transition-all" data-filter="not-voted">
                            Belum Vote
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if($users->isEmpty())
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">😔</div>
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada User</h4>
                    <p class="text-gray-500">User akan muncul setelah mendaftar di sistem.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    NIS & Kelas
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Status Voting
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Pilihan
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Bergabung
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100" id="userTable">
                            @foreach($users as $user)
                            <tr class="user-row hover:bg-gray-50 transition-colors" data-status="{{ $user->has_voted ? 'voted' : 'not-voted' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $user->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 font-medium">{{ $user->nis ?? '-' }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->kelas ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->has_voted)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                            Sudah Voting
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            <span class="w-2 h-2 bg-orange-500 rounded-full mr-1"></span>
                                            Belum Voting
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->vote)
                                        <div class="flex items-center">
                                            <div class="text-sm font-medium text-blue-600">{{ $user->vote->candidate->name }}</div>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $user->vote->created_at->format('d/m H:i') }}
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        @if($user->has_voted)
                                            <span class="text-green-600 bg-green-50 px-2 py-1 rounded text-xs">
                                                ✅ Telah Vote
                                            </span>
                                        @else
                                            <span class="text-orange-600 bg-orange-50 px-2 py-1 rounded text-xs">
                                                ⏳ Menunggu
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Statistics Summary -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-blue-700 font-medium">Total User</p>
                                <p class="text-2xl font-bold text-blue-800">{{ $users->count() }}</p>
                            </div>
                            <div class="text-3xl text-blue-600">👥</div>
                        </div>
                    </div>

                    <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-green-700 font-medium">Sudah Voting</p>
                                <p class="text-2xl font-bold text-green-800">{{ $users->where('has_voted', true)->count() }}</p>
                            </div>
                            <div class="text-3xl text-green-600">✅</div>
                        </div>
                    </div>

                    <div class="bg-orange-50 rounded-xl p-4 border border-orange-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-orange-700 font-medium">Belum Voting</p>
                                <p class="text-2xl font-bold text-orange-800">{{ $users->where('has_voted', false)->count() }}</p>
                            </div>
                            <div class="text-3xl text-orange-600">⏳</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Export Data -->
        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-lg text-white p-6">
            <h4 class="text-lg font-semibold mb-3">📥 Export Data</h4>
            <p class="text-indigo-100 mb-4">Export data user dan voting dalam format Excel atau JSON.</p>
            <a href="{{ route('admin.export.data') }}"
               class="inline-flex items-center bg-white text-indigo-600 px-4 py-2 rounded-lg font-medium hover:bg-indigo-50 transition-colors">
                <span class="mr-2">📄</span> Export Data
            </a>
        </div>

        <!-- Reset Voting -->
        <div class="bg-gradient-to-br from-red-500 to-orange-500 rounded-2xl shadow-lg text-white p-6">
            <h4 class="text-lg font-semibold mb-3">🔄 Reset System</h4>
            <p class="text-red-100 mb-4">Reset semua data voting (hati-hati, tindakan ini tidak dapat dibatalkan!).</p>
            <form action="{{ route('admin.reset.voting') }}" method="POST"
                  onsubmit="return confirm('⚠️ Yakin reset semua data voting? SEMUA DATA AKAN HILANG!')">
                @csrf
                <button type="submit"
                        class="inline-flex items-center bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-50 transition-colors">
                    <span class="mr-2">🔄</span> Reset Voting
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function filterUsers(status) {
    const rows = document.querySelectorAll('.user-row');
    const buttons = document.querySelectorAll('.filter-btn');

    // Update active button
    buttons.forEach(btn => {
        btn.classList.remove('active', 'bg-white', 'text-indigo-600', 'shadow-sm');
        if (btn.dataset.filter === status) {
            btn.classList.add('active', 'bg-white', 'text-indigo-600', 'shadow-sm');
        }
    });

    // Filter rows
    rows.forEach(row => {
        if (status === 'all') {
            row.style.display = '';
        } else {
            if (row.dataset.status === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}

// Initialize with all users shown
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('[data-filter="all"]').classList.add('active', 'bg-white', 'text-indigo-600', 'shadow-sm');
});
</script>

<style>
.filter-btn.active {
    background-color: white;
    color: #4f46e5;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
</style>
@endsection
