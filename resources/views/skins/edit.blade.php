@extends('layouts.app-dashboard')

@section('title', 'Edit Skin')

@section('content')
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center mb-3 space-x-2 text-sm text-gray-600 dark:text-gray-400">
            <a href="{{ route('skins.index') }}"
                class="transition-colors hover:text-red-600 dark:hover:text-red-400">Skins</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="font-medium text-gray-900 dark:text-white">Edit Skin</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Skin: {{ $skin->skin_name }}</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Perbarui informasi skin</p>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl">
        <div class="bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('skins.update', $skin) }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Weapon Selection -->
                <div>
                    <label for="weapon_id" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Pilih Weapon <span class="text-red-600">*</span>
                    </label>
                    <select name="weapon_id" id="weapon_id"
                        class="w-full px-4 py-2.5 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 @error('weapon_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Weapon --</option>
                        @foreach ($weapons as $weapon)
                            <option value="{{ $weapon->id }}"
                                {{ old('weapon_id', $skin->weapon_id) == $weapon->id ? 'selected' : '' }}>
                                {{ $weapon->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('weapon_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Skin Name -->
                <div>
                    <label for="skin_name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Nama Skin <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="skin_name" id="skin_name" value="{{ old('skin_name', $skin->skin_name) }}"
                        class="w-full px-4 py-2.5 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 @error('skin_name') border-red-500 @enderror"
                        placeholder="Contoh: Kuronami Vandal" required>
                    @error('skin_name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rarity -->
                <div>
                    <label for="rarity" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Rarity <span class="text-red-600">*</span>
                    </label>
                    <select name="rarity" id="rarity"
                        class="w-full px-4 py-2.5 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 @error('rarity') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Rarity --</option>
                        
                        <option value="Select" {{ old('rarity', $skin->rarity) == 'Select' ? 'selected' : '' }}>Select
                        </option>

                        <option value="Deluxe" {{ old('rarity', $skin->rarity) == 'Deluxe' ? 'selected' : '' }}>Deluxe
                        </option>

                        <option value="Premium" {{ old('rarity', $skin->rarity) == 'Premium' ? 'selected' : '' }}>Premium
                        </option>
                        <option value="Exclusive" {{ old('rarity', $skin->rarity) == 'Exclusive' ? 'selected' : '' }}>
                            Exclusive</option>
                        <option value="Ultra" {{ old('rarity', $skin->rarity) == 'Ultra' ? 'selected' : '' }}>Ultra
                        </option>
                        <option value="Deluxe" {{ old('rarity', $skin->rarity) == 'Deluxe' ? 'selected' : '' }}>Deluxe
                        </option>
                    </select>
                    @error('rarity')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Harga (VP) <span class="text-red-600">*</span>
                    </label>
                    <input type="number" name="price" id="price" value="{{ old('price', $skin->price) }}"
                        min="0" step="1"
                        class="w-full px-4 py-2.5 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 @error('price') border-red-500 @enderror"
                        placeholder="Contoh: 2175" required>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if ($skin->image_url)
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Gambar Saat Ini
                        </label>
                        <img src="{{ $skin->image_url }}" alt="{{ $skin->skin_name }}"
                            class="object-cover w-32 h-32 border-2 border-gray-300 rounded-lg dark:border-gray-600"
                            onerror="this.src='https://via.placeholder.com/128?text=No+Image'">
                    </div>
                @endif

                <!-- Image Upload/URL -->
                <div>
                    <label class="block mb-3 text-sm font-semibold text-gray-700 dark:text-gray-300">
                        {{ $skin->image_url ? 'Ganti Gambar (Opsional)' : 'Gambar Skin (Opsional)' }}
                    </label>

                    <!-- Image Source Selection -->
                    <div class="flex items-center mb-4 space-x-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="image_source" value="upload" id="image_source_upload"
                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                checked onchange="toggleImageInput()">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Upload File</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="image_source" value="url" id="image_source_url"
                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                onchange="toggleImageInput()">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Input URL</span>
                        </label>
                    </div>

                    <!-- File Upload Input -->
                    <div id="upload_input_container">
                        <input type="file" name="image_file" id="image_file" accept="image/*"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image_file') border-red-500 @enderror"
                            onchange="previewImage(event, 'file')">
                        @error('image_file')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            <svg class="inline w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Format: JPG, PNG, GIF (Max: 2MB)
                        </p>
                    </div>

                    <!-- URL Input -->
                    <div id="url_input_container" class="hidden">
                        <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}"
                            class="w-full px-4 py-2.5 text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 @error('image_url') border-red-500 @enderror"
                            placeholder="https://example.com/image.jpg" onchange="previewImage(event, 'url')">
                        @error('image_url')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            <svg class="inline w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Masukkan URL gambar yang valid
                        </p>
                    </div>

                    <!-- Image Preview -->
                    <div id="imagePreview" class="hidden mt-3">
                        <img src="" alt="Preview"
                            class="object-cover w-32 h-32 border-2 border-gray-300 rounded-lg dark:border-gray-600">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end pt-4 space-x-3 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('skins.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-700 rounded-lg hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all shadow-md hover:shadow-lg">
                        <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Skin
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function toggleImageInput() {
                const isUpload = document.getElementById('image_source_upload').checked;
                const uploadContainer = document.getElementById('upload_input_container');
                const urlContainer = document.getElementById('url_input_container');
                const preview = document.getElementById('imagePreview');

                if (isUpload) {
                    uploadContainer.classList.remove('hidden');
                    urlContainer.classList.add('hidden');
                    // Clear URL input
                    document.getElementById('image_url').value = '';
                } else {
                    uploadContainer.classList.add('hidden');
                    urlContainer.classList.remove('hidden');
                    // Clear file input
                    document.getElementById('image_file').value = '';
                }

                // Hide preview when switching
                preview.classList.add('hidden');
            }

            function previewImage(event, source) {
                const preview = document.getElementById('imagePreview');
                const img = preview.querySelector('img');

                if (source === 'file') {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            img.src = e.target.result;
                            preview.classList.remove('hidden');
                        }
                        reader.readAsDataURL(file);
                    } else {
                        preview.classList.add('hidden');
                    }
                } else if (source === 'url') {
                    const url = event.target.value;
                    if (url) {
                        // Validate URL format (basic check)
                        try {
                            new URL(url);
                            img.src = url;
                            preview.classList.remove('hidden');

                            // Handle image load error
                            img.onerror = function() {
                                preview.classList.add('hidden');
                                alert('Gagal memuat gambar dari URL. Pastikan URL valid dan dapat diakses.');
                            };
                        } catch (e) {
                            preview.classList.add('hidden');
                        }
                    } else {
                        preview.classList.add('hidden');
                    }
                }
            }
        </script>
    @endpush
@endsection
