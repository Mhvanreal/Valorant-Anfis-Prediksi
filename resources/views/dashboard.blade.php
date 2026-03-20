@extends('layouts.app-dashboard')

@section('content')
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">
            Selamat Datang, {{ auth()->user()->name }}! 👋
        </h1>
        <p class="text-gray-600 dark:text-gray-400">
            Hari ini: <span
                class="font-semibold text-gray-800 dark:text-gray-300">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">

        <div
            class="relative overflow-hidden transition-all duration-300 shadow-lg bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl hover:shadow-xl hover:scale-105">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm font-medium text-blue-100">Total Prediksi</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format(0) }}</h3>
                        <p class="mt-2 text-xs text-blue-100">
                            <span class="font-semibold">+12%</span> dari bulan lalu
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-center w-16 h-16 bg-white rounded-full bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600"></div>
        </div>

        <!-- Card 2: Total Skin -->
        <div
            class="relative overflow-hidden transition-all duration-300 shadow-lg bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl hover:shadow-xl hover:scale-105">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm font-medium text-purple-100">Total Skin</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format(\App\Models\Skin::count()) }}</h3>
                        <p class="mt-2 text-xs text-purple-100">
                            <span class="font-semibold">{{ \App\Models\Skin::count() }}</span> skin terdaftar
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-center w-16 h-16 bg-white rounded-full bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-400 to-purple-600"></div>
        </div>

        <!-- Card 3: Total Users -->
        <div
            class="relative overflow-hidden transition-all duration-300 shadow-lg bg-gradient-to-br from-green-500 to-green-600 rounded-xl hover:shadow-xl hover:scale-105">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm font-medium text-green-100">Total Users</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format(\App\Models\User::count()) }}</h3>
                        <p class="mt-2 text-xs text-green-100">
                            <span class="font-semibold">+5</span> user baru minggu ini
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-center w-16 h-16 bg-white rounded-full bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-green-400 to-green-600"></div>
        </div>

        <!-- Card 4: Akurasi -->
        <div
            class="relative overflow-hidden transition-all duration-300 shadow-lg bg-gradient-to-br from-red-500 to-red-600 rounded-xl hover:shadow-xl hover:scale-105">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm font-medium text-red-100">Akurasi Prediksi</p>
                        <h3 class="text-3xl font-bold text-white">87.5%</h3>
                        <p class="mt-2 text-xs text-red-100">
                            <span class="font-semibold">↑ 3.2%</span> dari rata-rata
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-center w-16 h-16 bg-white rounded-full bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-red-400 to-red-600"></div>
        </div>

    </div>
@endsection
