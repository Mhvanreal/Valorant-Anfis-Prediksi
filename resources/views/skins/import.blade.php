@extends('layouts.app-dashboard')

@section('title', 'Import Skins')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <div class="flex items-center mb-3 space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <a href="{{ route('skins.index') }}"
                    class="transition-colors hover:text-red-600 dark:hover:text-red-400">Skins</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="font-medium text-gray-900 dark:text-white">Import Excel</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Import Skins</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Upload file Excel untuk menambahkan atau memperbarui
                data skin secara massal</p>
        </div>
        <a href="{{ route('skins.index') }}"
            class="inline-flex items-center px-4 py-2 space-x-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="flex items-start p-4 mb-5 border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:border-green-800">
            <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-green-600 dark:text-green-400" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="text-sm font-semibold text-green-800 dark:text-green-400">Import Berhasil</p>
                <p class="mt-0.5 text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="flex items-start p-4 mb-5 border border-yellow-200 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 dark:border-yellow-800">
            <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-yellow-600 dark:text-yellow-400" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-400">Import Selesai dengan Peringatan</p>
                <p class="mt-0.5 text-sm text-yellow-700 dark:text-yellow-300">{{ session('warning') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="flex items-start p-4 mb-5 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/20 dark:border-red-800">
            <svg class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-red-600 dark:text-red-400" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="text-sm font-semibold text-red-800 dark:text-red-400">Import Gagal</p>
                <p class="mt-0.5 text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if (session('import_errors') && is_array(session('import_errors')))
        <div class="p-4 mb-5 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/20 dark:border-red-800">
            <div class="flex items-center mb-3">
                <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="text-sm font-semibold text-red-800 dark:text-red-400">Detail Error Import</p>
            </div>
            <ul class="space-y-1">
                @foreach (session('import_errors') as $error)
                    <li class="flex items-start text-sm text-red-700 dark:text-red-300">
                        <span class="mr-2 mt-0.5 text-red-400">•</span>
                        {{ $error }}
                    </li>
                @endforeach
                @if (session('total_errors') && session('total_errors') > 10)
                    <li class="pt-1 text-sm font-semibold text-red-600 border-t border-red-200 dark:text-red-400">
                        ... dan {{ session('total_errors') - 10 }} error lainnya
                    </li>
                @endif
            </ul>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-5 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/20 dark:border-red-800">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-semibold text-red-800 dark:text-red-400">Validasi Gagal</p>
            </div>
            <ul class="space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-700 dark:text-red-300">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        <!-- Left Column: Format & Steps -->
        <div class="space-y-6 lg:col-span-1">

            <!-- Step Guide -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                        <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Langkah Import
                    </h3>
                </div>
                <div class="p-5">
                    <ol class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <span
                                class="flex-shrink-0 flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-600 rounded-full">1</span>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Download Template</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Unduh template CSV sebagai acuan format
                                    data</p>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span
                                class="flex-shrink-0 flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-600 rounded-full">2</span>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Isi Data</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Lengkapi kolom sesuai format yang
                                    ditentukan</p>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span
                                class="flex-shrink-0 flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-600 rounded-full">3</span>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Upload File</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Upload file .xlsx, .xls, atau .csv
                                    (maks 10MB)</p>
                            </div>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span
                                class="flex-shrink-0 flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-green-600 rounded-full">✓</span>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Selesai</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Sistem otomatis buat atau update data
                                    skin</p>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>

            <!-- Column Reference -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M3 14h18M10 6h4M10 18h4" />
                        </svg>
                        Referensi Kolom
                    </h3>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @php
                        $columns = [
                            ['name' => 'uuid', 'desc' => 'ID unik skin', 'required' => true],
                            ['name' => 'weapon', 'desc' => 'Nama weapon (misal: Vandal)', 'required' => true],
                            ['name' => 'skin_name', 'desc' => 'Nama skin', 'required' => true],
                            ['name' => 'price', 'desc' => 'Harga dalam VP', 'required' => false],
                            ['name' => 'rarity', 'desc' => 'Tingkat kelangkaan', 'required' => false],
                            ['name' => 'is_battlepass', 'desc' => 'Yes/No battlepass skin', 'required' => false],
                            ['name' => 'popularity', 'desc' => 'Skor popularitas (0–10)', 'required' => false],
                            ['name' => 'vfx', 'desc' => 'Nilai visual effect (1–10)', 'required' => false],
                            ['name' => 'image_url', 'desc' => 'URL gambar skin', 'required' => false],
                            ['name' => 'theme_uuid', 'desc' => 'UUID tema skin', 'required' => false],
                            ['name' => 'score', 'desc' => 'Skor keseluruhan', 'required' => false],
                        ];
                    @endphp
                    @foreach ($columns as $col)
                        <div class="flex items-center justify-between px-5 py-2.5">
                            <div class="flex items-center space-x-2">
                                <code
                                    class="px-1.5 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded font-mono">{{ $col['name'] }}</code>
                                @if ($col['required'])
                                    <span
                                        class="px-1.5 py-0.5 text-xs font-semibold text-red-700 bg-red-100 rounded dark:bg-red-900/30 dark:text-red-400">Wajib</span>
                                @else
                                    <span
                                        class="px-1.5 py-0.5 text-xs font-semibold text-gray-500 bg-gray-100 rounded dark:bg-gray-700 dark:text-gray-400">Opsional</span>
                                @endif
                            </div>
                            <p class="text-xs text-right text-gray-500 dark:text-gray-400 max-w-[140px]">
                                {{ $col['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Important Note -->
            <div class="p-4 border border-yellow-200 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 dark:border-yellow-800">
                <div class="flex items-start space-x-3">
                    <svg class="flex-shrink-0 w-5 h-5 mt-0.5 text-yellow-600 dark:text-yellow-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-400">Catatan Penting</p>
                        <ul class="mt-1 space-y-1 text-xs text-yellow-700 dark:text-yellow-300">
                            <li>• Kolom <strong>vfx</strong> diisi nilai desimal antara 1–10</li>
                            <li>• Jika UUID sudah ada, data akan diperbarui (update)</li>
                            <li>• Jika weapon tidak ditemukan, baris akan dilewati</li>
                            <li>• Pastikan semua weapon sudah ada di database</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Upload Form -->
        <div class="space-y-6 lg:col-span-2">

            <!-- Download Template Card -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                        <span
                            class="flex items-center justify-center w-6 h-6 mr-2 text-xs font-bold text-white bg-green-600 rounded-full">1</span>
                        Download Template
                    </h3>
                </div>
                <div class="p-6">
                    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        Download template CSV berikut sebagai panduan pengisian data. Template sudah mencakup semua kolom
                        yang diperlukan termasuk kolom <strong class="text-gray-900 dark:text-white">vfx</strong>.
                    </p>
                    <div
                        class="flex items-center justify-between p-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <div class="flex items-center space-x-3">
                            <div
                                class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-lg dark:bg-green-900/30">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">template_import_skins.csv
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">11 kolom • 3 baris contoh data</p>
                            </div>
                        </div>
                        <a href="{{ route('skins.import.template') }}"
                            class="inline-flex items-center px-4 py-2 space-x-2 text-sm font-medium text-white transition-all duration-200 rounded-lg shadow bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span>Download</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Upload Form Card -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                        <span
                            class="flex items-center justify-center w-6 h-6 mr-2 text-xs font-bold text-white bg-red-600 rounded-full">2</span>
                        Upload File Excel / CSV
                    </h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('skins.import') }}" method="POST" enctype="multipart/form-data"
                        id="importForm" class="space-y-5">
                        @csrf

                        <!-- Dropzone Area -->
                        <div id="dropzone"
                            class="relative flex flex-col items-center justify-center p-8 transition-colors border-2 border-dashed rounded-lg cursor-pointer border-gray-300 dark:border-gray-600 hover:border-red-400 dark:hover:border-red-500 bg-gray-50 dark:bg-gray-700/50"
                            onclick="document.getElementById('fileInput').click()">
                            <div id="dropzone-idle">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400 dark:text-gray-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Klik untuk pilih file atau drag & drop di sini
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    .xlsx, .xls, .csv — Maksimal 10MB
                                </p>
                            </div>
                            <div id="dropzone-selected" class="hidden text-center">
                                <svg class="w-10 h-10 mx-auto mb-2 text-green-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white" id="selected-filename">
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400" id="selected-filesize"></p>
                                <button type="button"
                                    class="mt-2 text-xs text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                                    onclick="clearFile(event)">Ganti file</button>
                            </div>
                        </div>
                        <input type="file" name="file" id="fileInput" accept=".xlsx,.xls,.csv" class="hidden"
                            onchange="handleFileSelect(this)">

                        @error('file')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        <!-- VFX Info Banner -->
                        <div class="flex items-start p-4 space-x-3 border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800">
                            <svg class="flex-shrink-0 w-5 h-5 mt-0.5 text-blue-600 dark:text-blue-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-blue-800 dark:text-blue-300">Kolom VFX (Visual
                                    Effect)</p>
                                <p class="mt-0.5 text-xs text-blue-700 dark:text-blue-400">
                                    Isi kolom <code
                                        class="px-1 bg-blue-100 dark:bg-blue-900/50 rounded font-mono">vfx</code>
                                    dengan nilai desimal antara <strong>1.0</strong> hingga <strong>10.0</strong>.
                                    Nilai ini merepresentasikan intensitas efek visual skin (animasi, partikel, cahaya)
                                    yang digunakan sebagai fitur input model ANFIS.
                                </p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-2">
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Data dengan UUID yang sudah ada akan diperbarui secara otomatis
                            </p>
                            <button type="submit" id="submitBtn"
                                class="inline-flex items-center px-5 py-2.5 space-x-2 text-sm font-medium text-white transition-all duration-200 rounded-lg shadow bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <span id="submitText">Upload & Import</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- VFX Score Guide -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                        <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Panduan Nilai VFX
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-5">
                        @php
                            $vfxGuide = [
                                ['range' => '1–2', 'label' => 'Minimal', 'desc' => 'Tidak ada atau hampir tidak ada efek', 'color' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300'],
                                ['range' => '3–4', 'label' => 'Ringan', 'desc' => 'Efek sederhana, warna saja', 'color' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400'],
                                ['range' => '5–6', 'label' => 'Sedang', 'desc' => 'Animasi terbatas, partikel kecil', 'color' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400'],
                                ['range' => '7–8', 'label' => 'Tinggi', 'desc' => 'Animasi kompleks, efek cahaya', 'color' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400'],
                                ['range' => '9–10', 'label' => 'Ekstrem', 'desc' => 'Efek penuh, partikel masif', 'color' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'],
                            ];
                        @endphp
                        @foreach ($vfxGuide as $guide)
                            <div class="p-3 rounded-lg {{ $guide['color'] }}">
                                <div class="mb-1 text-lg font-bold">{{ $guide['range'] }}</div>
                                <div class="text-xs font-semibold">{{ $guide['label'] }}</div>
                                <div class="mt-1 text-xs opacity-80">{{ $guide['desc'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('fileInput');
            const submitBtn = document.getElementById('submitBtn');

            // Drag & drop events
            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('border-red-400', 'dark:border-red-500', 'bg-red-50', 'dark:bg-red-900/10');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('border-red-400', 'dark:border-red-500', 'bg-red-50', 'dark:bg-red-900/10');
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-red-400', 'dark:border-red-500', 'bg-red-50', 'dark:bg-red-900/10');
                const file = e.dataTransfer.files[0];
                if (file) {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    fileInput.files = dt.files;
                    showFileInfo(file);
                }
            });

            function handleFileSelect(input) {
                if (input.files && input.files[0]) {
                    showFileInfo(input.files[0]);
                }
            }

            function showFileInfo(file) {
                document.getElementById('dropzone-idle').classList.add('hidden');
                document.getElementById('dropzone-selected').classList.remove('hidden');
                document.getElementById('selected-filename').textContent = file.name;
                document.getElementById('selected-filesize').textContent = formatBytes(file.size);
                submitBtn.disabled = false;
            }

            function clearFile(event) {
                event.stopPropagation();
                fileInput.value = '';
                document.getElementById('dropzone-idle').classList.remove('hidden');
                document.getElementById('dropzone-selected').classList.add('hidden');
                submitBtn.disabled = true;
            }

            function formatBytes(bytes) {
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
            }

            // Loading state on submit
            document.getElementById('importForm').addEventListener('submit', () => {
                submitBtn.disabled = true;
                document.getElementById('submitText').textContent = 'Memproses...';
            });
        </script>
    @endpush
@endsection
