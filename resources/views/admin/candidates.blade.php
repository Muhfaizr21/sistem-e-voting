@extends('layouts.admin')

@section('header', 'Kelola Kandidat')

@section('content')
<div class="space-y-6">
    <!-- Add Candidate Form -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="p-6 border-b">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <span class="mr-2">➕</span>
                Tambah Kandidat Baru
            </h3>
        </div>

        <div class="p-6">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <strong class="font-bold">❌ Error:</strong>
                    <ul class="mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kandidat *</label>
                        <input type="text" name="name" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               value="{{ old('name') }}"
                               placeholder="Contoh: Ahmad Rizki">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas *</label>
                        <input type="text" name="class" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               value="{{ old('class') }}"
                               placeholder="Contoh: XII IPA 1">
                        @error('class')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Visi *</label>
                    <textarea name="vision" rows="3" required
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                              placeholder="Tuliskan visi kandidat...">{{ old('vision') }}</textarea>
                    @error('vision')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Misi *</label>
                    <textarea name="mission" rows="3" required
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                              placeholder="Tuliskan misi kandidat...">{{ old('mission') }}</textarea>
                    @error('mission')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kandidat (Opsional)</label>
                    <input type="file" name="photo" accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <p class="text-xs text-gray-500 mt-2">Format: JPEG, PNG, JPG, GIF | Maksimal: 5MB</p>
                    @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition flex items-center">
                        <span class="mr-2">➕</span>
                        Tambah Kandidat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Candidates List -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="p-6 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <span class="mr-2">👥</span>
                    Daftar Kandidat
                    <span class="ml-2 bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">
                        {{ $candidates->count() }}
                    </span>
                </h3>
                <div class="text-sm text-gray-500">
                    Total Suara: <span class="font-semibold">{{ $candidates->sum('vote_count') }}</span>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if($candidates->isEmpty())
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">👥</div>
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Kandidat</h4>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan kandidat pertama di form atas.</p>
                </div>
            @else
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
                                    Visi & Misi
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Suara
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($candidates as $candidate)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            @if($candidate->photo)
                                                <img class="h-12 w-12 rounded-full object-cover border-2 border-blue-300"
                                                     src="{{ asset('storage/' . $candidate->photo) }}"
                                                     alt="{{ $candidate->name }}"
                                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDgiIGhlaWdodD0iNDgiIHZpZXdCb3g9IjAgMCA0OCA0OCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjQ4IiBoZWlnaHQ9IjQ4IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0yNCAyOEMyOC40MTgzIDI4IDMyIDI0LjQxODMgMzIgMjBDMzIgMTUuNTgxNyAyOC40MTgzIDEyIDI0IDEyQzE5LjU4MTcgMTIgMTYgMTUuNTgxNyAxNiAyMEMxNiAyNC40MTgzIDE5LjU4MTcgMjggMjQgMjhaTTI0IDMyQzE4LjQ3IDMyIDE0IDM2LjQ3IDE0IDQySDM0QzM0IDM2LjQ3IDI5LjUzIDMyIDI0IDMyWiIgZmlsbD0iIzlDQTBBRiIvPgo8L3N2Zz4K'">
                                            @else
                                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center border-2 border-blue-300">
                                                    <span class="text-blue-500 text-lg">👤</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $candidate->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                Ditambah: {{ $candidate->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $candidate->class }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs">
                                        <div class="mb-1">
                                            <span class="font-medium text-green-600">Visi:</span>
                                            <p class="text-gray-600 line-clamp-1">{{ Str::limit($candidate->vision, 50) }}</p>
                                        </div>
                                        <div>
                                            <span class="font-medium text-green-600">Misi:</span>
                                            <p class="text-gray-600 line-clamp-1">{{ Str::limit($candidate->mission, 50) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-center">
                                        <span class="text-2xl font-bold text-blue-600">{{ $candidate->vote_count }}</span>
                                        <p class="text-xs text-gray-500">suara</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.candidates.edit', $candidate->id) }}"
                                           class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 px-3 py-2 rounded-lg transition flex items-center">
                                            <span class="mr-1">✏️</span> Edit
                                        </a>

                                        <form action="{{ route('admin.candidates.delete', $candidate->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus kandidat {{ $candidate->name }}? Semua data termasuk suara akan dihapus permanen!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-3 py-2 rounded-lg transition flex items-center">
                                                <span class="mr-1">🗑️</span> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Statistics -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <div class="text-2xl font-bold text-green-600">{{ $candidates->sum('vote_count') }}</div>
                        <div class="text-sm text-green-700">Total Suara</div>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                        <div class="text-2xl font-bold text-blue-600">{{ $candidates->count() }}</div>
                        <div class="text-sm text-blue-700">Total Kandidat</div>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                        @php
                            $mostVoted = $candidates->sortByDesc('vote_count')->first();
                        @endphp
                        <div class="text-lg font-bold text-purple-600 truncate">
                            {{ $mostVoted && $mostVoted->vote_count > 0 ? $mostVoted->name : '-' }}
                        </div>
                        <div class="text-sm text-purple-700">Paling Banyak Suara</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
