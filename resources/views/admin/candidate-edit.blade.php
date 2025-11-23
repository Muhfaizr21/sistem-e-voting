@extends('layouts.admin')

@section('header', 'Edit Kandidat')

@section('slot')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="p-6 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <span class="mr-2">✏️</span>
                    Edit Kandidat - {{ $candidate->name }}
                </h3>
                <a href="{{ route('admin.candidates') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
                    <span class="mr-2">←</span> Kembali
                </a>
            </div>
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

            <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kandidat *</label>
                        <input type="text" name="name" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               value="{{ old('name', $candidate->name) }}"
                               placeholder="Contoh: Ahmad Rizki">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kelas *</label>
                        <input type="text" name="class" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               value="{{ old('class', $candidate->class) }}"
                               placeholder="Contoh: XII IPA 1">
                        @error('class')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Visi *</label>
                    <textarea name="vision" rows="4" required
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                              placeholder="Tuliskan visi kandidat...">{{ old('vision', $candidate->vision) }}</textarea>
                    @error('vision')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Misi *</label>
                    <textarea name="mission" rows="4" required
                              class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                              placeholder="Tuliskan misi kandidat...">{{ old('mission', $candidate->mission) }}</textarea>
                    @error('mission')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kandidat</label>

                    <!-- Current Photo -->
                    @if($candidate->photo)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Foto Saat Ini:</p>
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $candidate->photo) }}"
                                     alt="{{ $candidate->name }}"
                                     class="w-20 h-20 rounded-full object-cover border-2 border-blue-500"
                                     onerror="this.style.display='none'">
                                <div>
                                    <p class="text-sm text-gray-600">Foto akan diganti jika upload file baru</p>
                                    <label class="flex items-center mt-2 text-sm text-gray-600">
                                        <input type="checkbox" name="remove_photo" value="1" class="mr-2">
                                        Hapus foto saat ini
                                    </label>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-600 mb-2">Belum ada foto</p>
                    @endif

                    <!-- New Photo Upload -->
                    <input type="file" name="photo" accept="image/*"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <p class="text-xs text-gray-500 mt-2">Format: JPEG, PNG, JPG, GIF | Maksimal: 5MB</p>
                    @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-6 border-t">
                    <div class="text-sm text-gray-500">
                        Terakhir update: {{ $candidate->updated_at->translatedFormat('d F Y H:i') }}
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.candidates') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition flex items-center">
                            <span class="mr-2">💾</span>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
