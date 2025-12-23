<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12">
        <!-- Logo/Title -->
        <div class="mb-8">
            {{-- <a href="/" class="block text-center">
                <h1 class="text-3xl font-bold">
                    <span class="bg-gradient-to-r from-red-500 via-red-600 to-red-500 bg-clip-text text-transparent">
                        Valorant Prediksi
                    </span>
                </h1>
            </a> --}}
        </div>

        <!-- Card Container -->
        <div class="w-full sm:max-w-md">
            <div
                class="bg-gray-800/90 backdrop-blur-sm border border-red-500/30 shadow-2xl shadow-red-500/20 rounded-xl px-6 py-6">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-xs text-gray-500">
                &copy; {{ date('Y') }} Valorant Prediksi. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>
