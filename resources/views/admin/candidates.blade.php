@extends('layouts.admin')

@section('header', 'Kelola Kandidat')

@section('content')
<div class="space-y-6">
    <!-- Add Candidate Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <h3 class="text-xl font-bold text-gray-800 flex items-center">
                <span class="mr-3">➕</span>
                Tambah Kandidat Baru
            </h3>
        </div>

        <div class="p-6">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 animate-fade-in">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <span class="text-red-600 text-lg">❌</span>
                            </div>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-red-800 font-semibold">Terjadi kesalahan:</h4>
                            <ul class="mt-1 text-red-700 text-sm list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kandidat *</label>
                        <input type="text" name="name" required
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                               value="{{ old('name') }}"
                               placeholder="Contoh: Ahmad Rizki">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas *</label>
                        <input type="text" name="class" required
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                               value="{{ old('class') }}"
                               placeholder="Contoh: XII IPA 1">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Visi *</label>
                    <textarea name="vision" rows="3" required
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                              placeholder="Tuliskan visi kandidat...">{{ old('vision') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Misi *</label>
                    <textarea name="mission" rows="3" required
                              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                              placeholder="Tuliskan misi kandidat...">{{ old('mission') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kandidat (Opsional)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-indigo-400 transition duration-200">
                        <div class="space-y-1 text-center">
                            <span class="text-4xl mb-2 block">📷</span>
                            <div class="flex text-sm text-gray-600">
                                <label class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                    <span>Upload file</span>
                                    <input type="file" name="photo" accept="image/*" class="sr-only">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF maksimal 5MB</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-medium transition-colors duration-200 flex items-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <span class="mr-2">➕</span>
                        Tambah Kandidat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Candidates List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <span class="mr-3">👥</span>
                    Daftar Kandidat
                    <span class="ml-3 bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $candidates->count() }} Kandidat
                    </span>
                </h3>
                <div class="text-sm text-gray-500">
                    Total Suara: <span class="font-semibold text-gray-900">{{ $candidates->sum('vote_count') }}</span>
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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($candidates as $candidate)
                    <div class="bg-gradient-to-br from-white to-gray-50 border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300 hover:border-indigo-200 group">
                        <div class="text-center mb-4">
                            @if($candidate->photo)
                                <img src="{{ asset('storage/' . $candidate->photo) }}"
                                     alt="{{ $candidate->name }}"
                                     class="w-20 h-20 rounded-full mx-auto object-cover border-4 border-white shadow-lg group-hover:border-indigo-100 transition-colors">
                            @else
                                <div class="w-20 h-20 rounded-full mx-auto bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center border-4 border-white shadow-lg group-hover:border-indigo-100 transition-colors">
                                    <span class="text-indigo-500 text-2xl">👤</span>
                                </div>
                            @endif
                        </div>

                        <h4 class="text-lg font-bold text-center text-gray-800 mb-1">{{ $candidate->name }}</h4>
                        <p class="text-center text-gray-600 mb-3 text-sm bg-gray-100 py-1 rounded-full">{{ $candidate->class }}</p>

                        <div class="text-center mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                {{ $candidate->vote_count }} suara
                            </span>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div class="line-clamp-2">
                                <span class="font-semibold text-green-600">Visi:</span>
                                {{ Str::limit($candidate->vision, 60) }}
                            </div>
                        </div>

                        <div class="flex space-x-2">
                            <a href="{{ route('admin.candidates.edit', $candidate->id) }}"
                               class="flex-1 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 py-2 px-3 rounded-lg text-center text-sm font-medium transition-colors flex items-center justify-center">
                                <span class="mr-1">✏️</span> Edit
                            </a>

                            <form action="{{ route('admin.candidates.delete', $candidate->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Yakin hapus {{ $candidate->name }}?')"
                                        class="w-full bg-red-50 hover:bg-red-100 text-red-700 py-2 px-3 rounded-lg text-sm font-medium transition-colors flex items-center justify-center">
                                    <span class="mr-1">🗑️</span> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Statistics -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                        <div class="text-2xl font-bold text-green-600">{{ $candidates->sum('vote_count') }}</div>
                        <div class="text-sm text-green-700">Total Suara</div>
                    </div>
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                        <div class="text-2xl font-bold text-blue-600">{{ $candidates->count() }}</div>
                        <div class="text-sm text-blue-700">Total Kandidat</div>
                    </div>
                    <div class="bg-purple-50 rounded-xl p-4 border border-purple-200">
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
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
