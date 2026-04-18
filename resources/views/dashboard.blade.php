@extends('layouts.app-dashboard')

@section('content')
    @php
        $userId = auth()->id();
        $hasPredictionTable = \Illuminate\Support\Facades\Schema::hasTable('prediction_histories');

        $totalPrediksiSaya = $hasPredictionTable
            ? \App\Models\PredictionHistory::where('user_id', $userId)->count()
            : 0;

        $prediksiHariIni = $hasPredictionTable
            ? \App\Models\PredictionHistory::where('user_id', $userId)
                ->whereDate('created_at', now()->toDateString())
                ->count()
            : 0;

        $totalSkin = \App\Models\Skin::count();
        $totalWeapon = \App\Models\Weapon::count();
    @endphp

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
                        <p class="mb-1 text-sm font-medium text-blue-100">Total Prediksi Saya</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format($totalPrediksiSaya) }}</h3>
                        <p class="mt-2 text-xs text-blue-100">
                            Total riwayat prediksi yang sudah Anda simpan
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-center w-16 h-16 bg-white rounded-full shrink-0 aspect-square bg-opacity-20 backdrop-blur-sm">
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
                        <p class="mb-1 text-sm font-medium text-purple-100">Prediksi Hari Ini</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format($prediksiHariIni) }}</h3>
                        <p class="mt-2 text-xs text-purple-100">
                            Jumlah prediksi yang Anda simpan hari ini
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-center w-16 h-16 bg-white rounded-full shrink-0 aspect-square bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-400 to-purple-600"></div>
        </div>

        <!-- Card 3: Total Skin -->
        <div
            class="relative overflow-hidden transition-all duration-300 shadow-lg bg-gradient-to-br from-green-500 to-green-600 rounded-xl hover:shadow-xl hover:scale-105">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm font-medium text-green-100">Total Skin</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format($totalSkin) }}</h3>
                        <p class="mt-2 text-xs text-green-100">
                            Total skin yang terdaftar di sistem
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-center w-16 h-16 bg-white rounded-full shrink-0 aspect-square bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-green-400 to-green-600"></div>
        </div>

        <!-- Card 4: Total Weapon -->
        <div
            class="relative overflow-hidden transition-all duration-300 shadow-lg bg-gradient-to-br from-red-500 to-red-600 rounded-xl hover:shadow-xl hover:scale-105">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="mb-1 text-sm font-medium text-red-100">Total Weapon</p>
                        <h3 class="text-3xl font-bold text-white">{{ number_format($totalWeapon) }}</h3>
                        <p class="mt-2 text-xs text-red-100">
                            Total weapon yang tersedia untuk prediksi
                        </p>
                    </div>
                    <div
                        class="flex items-center justify-center w-16 h-16 bg-white rounded-full shrink-0 aspect-square bg-opacity-20 backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-red-400 to-red-600"></div>
        </div>

    </div>
@endsection
