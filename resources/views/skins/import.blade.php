@extends('layouts.app-dashboard')

@section('title', 'Manage Skins')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Alert Messages --}}
            @if (session('success'))
                <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded"
                    role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div class="relative px-4 py-3 mb-4 text-yellow-700 bg-yellow-100 border border-yellow-400 rounded"
                    role="alert">
                    <strong class="font-bold">Peringatan!</strong>
                    <span class="block sm:inline">{{ session('warning') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if (session('import_errors') && is_array(session('import_errors')))
                <div class="px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                    <strong class="font-bold">Error Details:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach (session('import_errors') as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                        @if (session('total_errors') && session('total_errors') > 10)
                            <li class="text-sm font-semibold">... dan {{ session('total_errors') - 10 }} error lainnya
                            </li>
                        @endif
                    </ul>
                </div>
            @endif

            @if ($errors->any())
                <div class="px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                    <strong class="font-bold">Validasi Error:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Card Instruksi --}}
            <div class="mb-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="mb-3 text-lg font-semibold">📋 Instruksi Import</h3>
                    <div class="p-4 rounded-lg bg-blue-50">
                        <ol class="space-y-2 text-sm list-decimal list-inside">
                            <li><strong>Download template</strong> Excel terlebih dahulu menggunakan tombol di bawah
                            </li>
                            <li><strong>Format Excel harus memiliki 6 kolom:</strong>
                                <ul class="mt-1 ml-6 list-disc list-inside">
                                    <li><code class="px-1 bg-gray-200 rounded">uuid</code> - ID unik untuk skin (wajib)
                                    </li>
                                    <li><code class="px-1 bg-gray-200 rounded">display_name</code> - Format: "NamaSkin
                                        NamaWeapon" (wajib)
                                        <br><span class="ml-6 text-xs">Contoh: ".EXE Vandal", ".SYS Bucky", ".SYS
                                            Melee"</span>
                                    </li>
                                    <li><code class="px-1 bg-gray-200 rounded">rarity</code> - Tingkat kelangkaan
                                        (opsional)</li>
                                    <li><code class="px-1 bg-gray-200 rounded">status</code> - Status skin: 'bp' untuk
                                        battlepass, kosong untuk bukan battlepass (opsional)
                                        <br><span class="ml-6 text-xs">Contoh: "bp" atau kosongkan</span>
                                    </li>
                                    <li><code class="px-1 bg-gray-200 rounded">price</code> - Harga dalam VP (opsional)
                                    </li>
                                    <li><code class="px-1 bg-gray-200 rounded">gambar</code> - URL gambar skin
                                        (opsional)</li>
                                </ul>
                            </li>
                            <li><strong>Pastikan nama weapon</strong> di display_name sesuai dengan data di database
                            </li>
                            <li><strong>Upload file</strong> Excel yang sudah diisi</li>
                            <li>Sistem akan otomatis:
                                <ul class="mt-1 ml-6 list-disc list-inside">
                                    <li>Memisahkan nama skin dan nama weapon</li>
                                    <li>Mencocokkan dengan weapon di database</li>
                                    <li>Membuat atau update data skin</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Card Upload Form --}}
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Download Template Button --}}
                    <div class="pb-6 mb-6 border-b">
                        <h3 class="mb-3 text-lg font-semibold">1. Download Template</h3>
                        <a href="{{ route('skins.import.template') }}"
                            class="inline-flex items-center px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Download Template Excel
                        </a>
                    </div>

                    {{-- Upload Form --}}
                    <div>
                        <h3 class="mb-3 text-lg font-semibold">2. Upload File Excel</h3>
                        <form action="{{ route('skins.import') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-4">
                            @csrf

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Pilih File Excel
                                </label>
                                <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                                    class="block w-full text-sm text-gray-500 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="mt-1 text-sm text-gray-500">
                                    Format yang didukung: .xlsx, .xls, .csv (Maksimal 10MB)
                                </p>
                            </div>

                            <div class="flex gap-3">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Upload & Import
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            {{-- Info Tambahan --}}
            <div class="p-4 mt-6 border-l-4 border-yellow-400 bg-yellow-50">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            <strong>Catatan Penting:</strong> Jika weapon tidak ditemukan di database, baris tersebut
                            akan dilewati.
                            Pastikan semua weapon sudah ada di database sebelum import.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
