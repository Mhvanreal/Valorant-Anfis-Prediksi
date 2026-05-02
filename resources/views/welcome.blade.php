<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Valorant Prediksi - Landing Page</title>
    <link rel="icon" type="image/png" href="{{ asset('img/LOGO_Valo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/LOGO_Valo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-fadeIn {
            animation: fadeIn 1s ease-out forwards;
        }

        .animate-slideInLeft {
            animation: slideInLeft 0.8s ease-out forwards;
        }

        .animate-slideInRight {
            animation: slideInRight 0.8s ease-out forwards;
        }

        .animate-scaleIn {
            animation: scaleIn 0.6s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }

        .delay-400 {
            animation-delay: 400ms;
        }

        .delay-500 {
            animation-delay: 500ms;
        }

        .gradient-text {
            background: linear-gradient(135deg, #FF4655 0%, #FD4556 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .valorant-bg {
            background: linear-gradient(135deg, #0F1923 0%, #1F2326 100%);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background: linear-gradient(135deg, #FF4655 0%, #FD4556 100%);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Modal styles */
        #skinsModal {
            backdrop-filter: blur(8px);
            animation: fadeIn 0.3s ease-out;
        }

        #skinsModal>div {
            animation: scaleIn 0.3s ease-out;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="antialiased bg-gray-900">
    <!-- Navigation -->
    <nav class="fixed z-50 w-full border-b shadow-lg bg-gray-900/95 backdrop-blur-md border-red-500/20 animate-fadeIn">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0">
                    <h1 class="text-xl font-bold md:text-2xl gradient-text">V-Tech</h1>
                </div>

                <div class="items-center hidden space-x-8 md:flex">
                    <a href="#beranda" class="font-medium text-gray-200 nav-link active hover:text-red-500">Beranda</a>
                    <a href="#gallery" class="font-medium text-gray-200 nav-link hover:text-red-500">Gallery</a>
                    <a href="#aboutme" class="font-medium text-gray-200 nav-link hover:text-red-500">About Me</a>
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 font-semibold text-white transition duration-300 transform rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:shadow-lg hover:shadow-red-500/50 hover:scale-105">
                        Sign In
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-200 hover:text-red-500 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden bg-gray-800 border-t md:hidden border-red-500/20">
            <div class="px-2 py-2 space-y-1">
                <a href="#beranda"
                    class="block px-3 py-1.5 text-sm text-gray-200 hover:bg-red-500/10 hover:text-red-500 rounded-md">Beranda</a>
                <a href="#gallery"
                    class="block px-3 py-1.5 text-sm text-gray-200 hover:bg-red-500/10 hover:text-red-500 rounded-md">Gallery</a>
                <a href="#aboutme"
                    class="block px-3 py-1.5 text-sm text-gray-200 hover:bg-red-500/10 hover:text-red-500 rounded-md">About
                    Me</a>
                <a href="{{ route('login') }}"
                    class="block mx-2 mt-2 mb-1 px-4 py-1.5 text-sm bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-medium text-center transition duration-300">
                    Sign In
                </a>
            </div>
        </div>
    </nav>

    <!-- Beranda Section -->
    <section id="beranda"
        class="flex items-center justify-center min-h-screen pt-16 bg-gradient-to-br from-gray-900 via-gray-800 to-black">
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8 md:py-20">
            <div class="grid items-center gap-8 md:grid-cols-2 md:gap-12">
                <div class="space-y-4 md:space-y-6">
                    <h2 class="text-3xl font-bold text-white sm:text-4xl md:text-5xl lg:text-6xl animate-slideInLeft">
                        Welcome to <span class="gradient-text">Valorant Prediksi</span>
                    </h2>
                    <p class="text-base text-gray-300 delay-200 md:text-xl animate-slideInLeft">
                        Prediksi skin Valorant terbaik dengan teknologi machine learning dan analisis data terkini.
                    </p>
                    {{-- <div class="flex gap-4 delay-300 animate-slideInLeft">
                        <button
                            class="px-8 py-3 font-semibold text-white transition duration-300 transform rounded-lg bg-gradient-to-r from-purple-600 to-blue-600 hover:shadow-lg hover:scale-105">
                            Get Started
                        </button>
                        <button
                            class="px-8 py-3 font-semibold text-purple-600 transition duration-300 border-2 border-purple-600 rounded-lg hover:bg-purple-50">
                            Learn More
                        </button>
                    </div> --}}
                </div>

                <div class="relative animate-slideInRight">
                    <div
                        class="flex items-center justify-center w-full h-64 shadow-2xl md:h-96 bg-gradient-to-br from-red-600 via-red-500 to-gray-900 rounded-2xl shadow-red-500/50 floating">
                        <img src="{{ asset('img/LOGO_Valo.png') }}" alt="Valorant Logo"
                            class="object-contain w-48 h-48 md:w-72 md:h-72 drop-shadow-2xl">
                    </div>
                    <div class="absolute w-16 h-16 bg-red-100 rounded-full opacity-75 top-2 right-2 md:w-24 md:h-24">
                    </div>
                    <div class="absolute w-20 h-20 bg-red-400 rounded-full opacity-75 bottom-2 left-2 md:w-32 md:h-32">
                    </div>
                </div>
            </div>

            <!-- Generate Data Section -->
            <div class="mt-12 delay-300 md:mt-20 animate-fadeInUp">
                <div
                    class="overflow-hidden bg-gray-800 border shadow-2xl border-red-500/20 rounded-xl md:rounded-2xl shadow-red-500/10">
                    <div class="p-4 bg-gradient-to-r from-red-600 to-red-700 md:p-6">
                        <h3 class="flex items-center text-lg font-bold text-white md:text-2xl">
                            {{-- <svg class="w-6 h-6 mr-2 md:w-8 md:h-8 md:mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg> --}}
                            Prediksi Skin Valorant
                        </h3>
                        <p class="mt-1 text-sm text-red-100 md:text-base md:mt-2">Generate rekomendasi skin Valorant
                            terbaik berdasarkan parameter yang kamu masukkan.
                        </p>
                    </div>

                    <div class="p-4 md:p-8">
                        <form id="generateDataForm" class="space-y-4 md:space-y-6">
                            @csrf
                            <!-- Input Parameters Grid -->
                            <div class="grid gap-4 md:grid-cols-2 md:gap-6">
                                <!-- Weapon -->
                                <div class="space-y-1.5 md:space-y-2">
                                    <label for="weapon"
                                        class="flex items-center block text-xs font-semibold text-gray-200 md:text-sm">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-red-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        Weapon
                                    </label>
                                    <select id="weapon" name="weapon" required
                                        class="w-full px-3 py-2 text-sm text-white transition bg-gray-700 border-2 border-gray-600 rounded-lg outline-none md:px-4 md:py-3 md:text-base focus:border-red-500 focus:ring-2 focus:ring-red-500/50">
                                        <option value="">-- Pilih Weapon --</option>
                                        @foreach ($weapons as $weapon)
                                            <option value="{{ $weapon->id }}">{{ $weapon->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Harga -->
                                <div class="space-y-1.5 md:space-y-2">
                                    <label for="price"
                                        class="flex items-center block text-xs font-semibold text-gray-200 md:text-sm">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-cyan-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Harga / budget (VP)
                                    </label>
                                    <input type="number" id="price" name="price" required
                                        class="w-full px-3 py-2 text-sm text-white transition bg-gray-700 border-2 border-gray-600 rounded-lg outline-none md:px-4 md:py-3 md:text-base focus:border-red-500 focus:ring-2 focus:ring-red-500/50"
                                        placeholder="Contoh: 2175" min="0" max="6000" step="1">
                                    <p class="text-xs text-gray-400">Range: 0 - 6000 VP</p>
                                </div>

                                <!-- Efek Visual -->
                                <div class="space-y-1.5 md:space-y-2">
                                    <label for="vfx"
                                        class="flex items-center block text-xs font-semibold text-gray-200 md:text-sm">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-cyan-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                        Efek Visual
                                    </label>
                                    <input type="number" id="vfx" name="vfx" required
                                        class="w-full px-3 py-2 text-sm text-white transition bg-gray-700 border-2 border-gray-600 rounded-lg outline-none md:px-4 md:py-3 md:text-base focus:border-red-500 focus:ring-2 focus:ring-red-500/50"
                                        placeholder="semakin besar nilai semakin bagus efeknya" min="0"
                                        max="10" step="0.1">
                                    <p class="text-xs text-gray-400">Range: 0 - 10 </p>
                                </div>

                                <!-- Rarity -->
                                <div class="space-y-1.5 md:space-y-2">
                                    <label for="rarity"
                                        class="flex items-center block text-xs font-semibold text-gray-200 md:text-sm">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-yellow-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        Rarity
                                    </label>
                                    <select id="rarity" name="rarity" required
                                        class="w-full px-3 py-2 text-sm text-white transition bg-gray-700 border-2 border-gray-600 rounded-lg outline-none md:px-4 md:py-3 md:text-base focus:border-red-500 focus:ring-2 focus:ring-red-500/50">
                                        <option value="">-- Pilih Rarity --</option>
                                        <option value="select">Select Edition</option>
                                        <option value="deluxe">Deluxe Edition</option>
                                        <option value="premium">Premium Edition</option>
                                        <option value="exclusive">Exclusive Edition</option>
                                        <option value="ultra">Ultra Edition</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Info Card -->
                            <div
                                class="p-3 border-l-4 border-red-500 rounded-lg bg-gradient-to-r from-gray-700 to-gray-800 md:p-4">
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 text-red-500 mr-2 md:mr-3 flex-shrink-0 mt-0.5"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-xs font-medium text-gray-100 md:text-sm">Parameter Prediksi</p>
                                        <p class="mt-1 text-xs text-gray-300">Model akan memprediksi rekomendasi skin
                                            berdasarkan parameter Weapon, Harga, Efek Visual, dan Rarity.
                                            Laravel mengirim nilai input apa adanya, lalu preprocessing dilakukan di
                                            sisi
                                            model/FastAPI.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2 pt-3 md:gap-4 md:pt-4">
                                <button type="submit"
                                    class="flex-1 px-4 py-2.5 md:px-8 md:py-4 text-sm md:text-base bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-semibold hover:shadow-xl hover:shadow-red-500/50 transform hover:scale-105 transition duration-300 flex items-center justify-center">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Prediksi Sekarang
                                </button>
                                <button type="button" id="resetBtn"
                                    class="px-4 py-2.5 md:px-8 md:py-4 text-sm md:text-base border-2 border-gray-600 text-gray-300 rounded-lg font-semibold hover:bg-gray-700 transition duration-300">
                                    Reset
                                </button>
                                <button type="button" id="openRawGeneratorBtn"
                                    class="px-4 py-2.5 md:px-8 md:py-4 text-sm md:text-base border-2 border-cyan-500/60 text-cyan-300 rounded-lg font-semibold hover:bg-cyan-500/10 transition duration-300">
                                    Generator Raw (Slide)
                                </button>
                            </div>
                        </form>

                        <!-- Progress Bar (Hidden by default) -->
                        <div id="progressSection" class="hidden mt-4 md:mt-6">
                            <div class="h-3 overflow-hidden bg-gray-700 rounded-full md:h-4">
                                <div id="progressBar"
                                    class="h-full transition-all duration-500 bg-gradient-to-r from-red-600 to-red-700"
                                    style="width: 0%"></div>
                            </div>
                            <p id="progressText" class="mt-2 text-sm text-center text-gray-300">Generating data...</p>
                        </div>

                        <!-- Result Section (Hidden by default) -->
                        <div id="resultSection"
                            class="hidden p-4 mt-4 border-2 border-green-500 rounded-lg shadow-lg md:mt-6 md:p-6 bg-gradient-to-r from-gray-700 to-gray-800 shadow-green-500/20">
                            <div class="flex items-start">
                                <svg class="flex-shrink-0 w-6 h-6 mr-2 text-green-600 md:w-8 md:h-8 md:mr-3"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex-1">
                                    <h4
                                        class="flex items-center mb-2 text-base font-bold text-green-800 md:text-xl md:mb-3">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-1.5 md:mr-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Prediksi Berhasil!
                                    </h4>
                                    <div id="resultText"
                                        class="mb-3 space-y-2 text-sm text-gray-100 md:text-base md:mb-4"></div>
                                    <div class="flex gap-2 md:gap-3">
                                        <button id="tryAgainBtn"
                                            class="px-4 py-1.5 md:px-6 md:py-2 text-sm md:text-base bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition flex items-center">
                                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4 mr-1.5 md:mr-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Coba Lagi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Raw Generator Slide Panel -->
            <div id="rawGeneratorBackdrop" class="fixed inset-0 z-40 hidden bg-black/60"></div>
            <aside id="rawGeneratorPanel"
                class="fixed top-0 right-0 z-50 w-full h-full max-w-xl p-4 transition-transform duration-300 ease-out transform translate-x-full">
                <div
                    class="flex flex-col h-full overflow-hidden border shadow-2xl bg-gray-900/95 border-cyan-500/30 rounded-2xl shadow-cyan-500/20">
                    <div
                        class="flex items-center justify-between p-4 border-b border-cyan-500/20 bg-gradient-to-r from-cyan-700 to-cyan-900 md:p-5">
                        <div>
                            <h4 class="text-lg font-bold text-white md:text-xl">Generator Rekomendasi skin Valorant
                                Store</h4>

                            <p class="mt-1 text-xs text-cyan-200/90 md:text-sm">Generate ini menyesuaikan store yang
                                ada di Valorant Anda. Masukkan skin yang available di store untuk diprediksi oleh model
                                ANFIS.</p>
                        </div>
                        <button type="button" id="closeRawGeneratorBtn"
                            class="px-3 py-1.5 text-sm font-semibold text-white rounded-lg bg-white/10 hover:bg-white/20 transition">
                            Tutup
                        </button>
                    </div>

                    <div class="flex-1 p-4 overflow-y-auto md:p-5">
                        <form id="rawGenerateForm" class="space-y-4">
                            @csrf

                            <div class="space-y-2">
                                <label for="available_skins_raw"
                                    class="text-xs font-semibold tracking-wide uppercase text-cyan-300">Available Skins
                                    (satu nama per baris)</label>
                                <textarea id="available_skins_raw" name="available_skins_raw" rows="6" required
                                    class="w-full px-3 py-2 text-sm text-white transition bg-gray-800 border-2 border-gray-700 rounded-lg outline-none md:text-base focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/40"
                                    placeholder="Kuronami Sheriff&#10;Prelude to Chaos Vandal&#10;Araxys 2.0 Melee&#10;Ion Phantom&#10;Prime Vandal"></textarea>
                            </div>

                            <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                                <div class="space-y-2">
                                    <label for="raw_price"
                                        class="text-xs font-semibold tracking-wide uppercase text-cyan-300">Price</label>
                                    <input type="number" id="raw_price" name="price" min="0"
                                        max="10000" step="1" required
                                        class="w-full px-3 py-2 text-sm text-white transition bg-gray-800 border-2 border-gray-700 rounded-lg outline-none md:text-base focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/40"
                                        placeholder="1600">
                                </div>
                                <div class="space-y-2">
                                    <label for="raw_rarity"
                                        class="text-xs font-semibold tracking-wide uppercase text-cyan-300">Rarity
                                        (1-5)</label>
                                    <input type="number" id="raw_rarity" name="rarity" min="1"
                                        max="5" step="1" required
                                        class="w-full px-3 py-2 text-sm text-white transition bg-gray-800 border-2 border-gray-700 rounded-lg outline-none md:text-base focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/40"
                                        placeholder="3">
                                </div>
                                <div class="space-y-2">
                                    <label for="raw_vfx"
                                        class="text-xs font-semibold tracking-wide uppercase text-cyan-300">VFX</label>
                                    <input type="number" id="raw_vfx" name="vfx" min="0"
                                        max="10" step="0.1" required
                                        class="w-full px-3 py-2 text-sm text-white transition bg-gray-800 border-2 border-gray-700 rounded-lg outline-none md:text-base focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/40"
                                        placeholder="7.5">
                                </div>
                            </div>

                            <div class="flex gap-3 pt-2">
                                <button type="submit"
                                    class="flex-1 px-4 py-2.5 text-sm md:text-base bg-gradient-to-r from-cyan-600 to-cyan-700 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-cyan-500/40 transition">
                                    Generate
                                </button>
                                <button type="button" id="rawResetBtn"
                                    class="px-4 py-2.5 text-sm md:text-base border-2 border-gray-600 text-gray-300 rounded-lg font-semibold hover:bg-gray-800 transition">
                                    Reset
                                </button>
                            </div>
                        </form>

                        <div id="rawProgressSection" class="hidden mt-4">
                            <div class="h-3 overflow-hidden bg-gray-700 rounded-full">
                                <div id="rawProgressBar"
                                    class="h-full transition-all duration-500 bg-gradient-to-r from-cyan-600 to-cyan-700"
                                    style="width: 0%"></div>
                            </div>
                            <p id="rawProgressText" class="mt-2 text-sm text-center text-gray-300">Mengirim request
                                raw...</p>
                        </div>

                        <div id="rawResultSection"
                            class="hidden p-4 mt-4 border rounded-lg bg-gray-800/80 border-cyan-500/40">
                            <h5 class="mb-2 text-sm font-semibold text-cyan-300 md:text-base">Hasil Generator Raw</h5>
                            <div id="rawResultText" class="space-y-2 text-sm text-gray-100"></div>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- Features -->
            <div class="grid gap-4 mt-12 md:grid-cols-3 md:gap-8 md:mt-20">
                <div
                    class="p-6 bg-gray-800 border shadow-lg border-red-500/20 md:p-8 rounded-xl shadow-red-500/10 card-hover animate-scaleIn">
                    <div
                        class="flex items-center justify-center w-12 h-12 mb-3 rounded-full md:w-16 md:h-16 bg-red-500/20 md:mb-4">
                        <svg class="w-6 h-6 text-red-500 md:w-8 md:h-8" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-100 mb-1.5 md:mb-2">Fast & Accurate</h3>
                    <p class="text-sm text-gray-300 md:text-base">Prediksi cepat dan akurat menggunakan algoritma
                        terbaru</p>
                </div>

                <div
                    class="p-6 delay-200 bg-gray-800 border shadow-lg border-cyan-400/20 md:p-8 rounded-xl shadow-cyan-400/10 card-hover animate-scaleIn">
                    <div
                        class="flex items-center justify-center w-12 h-12 mb-3 rounded-full md:w-16 md:h-16 bg-cyan-400/20 md:mb-4">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-cyan-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-100 mb-1.5 md:mb-2">Secure & Reliable</h3>
                    <p class="text-sm text-gray-300 md:text-base">Data aman dengan sistem keamanan tingkat tinggi</p>
                </div>

                <div
                    class="p-6 bg-gray-800 border shadow-lg border-red-400/20 md:p-8 rounded-xl shadow-red-400/10 card-hover animate-scaleIn delay-400">
                    <div
                        class="flex items-center justify-center w-12 h-12 mb-3 rounded-full md:w-16 md:h-16 bg-red-400/20 md:mb-4">
                        <svg class="w-6 h-6 text-red-400 md:w-8 md:h-8" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-100 mb-1.5 md:mb-2">24/7 Support</h3>
                    <p class="text-sm text-gray-300 md:text-base">Dukungan penuh kapan saja Anda membutuhkan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="min-h-screen py-12 bg-gray-900 md:py-20">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-12 text-center md:mb-16 animate-fadeInUp">
                <h2 class="mb-3 text-3xl font-bold text-gray-100 md:text-4xl lg:text-5xl md:mb-4">
                    Weapon <span class="gradient-text">Gallery</span>
                </h2>
                <p class="text-base text-gray-300 md:text-xl">Pilih weapon untuk melihat koleksi skin-nya
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-8">
                @php
                    $cardBackgrounds = [
                        'bg-slate-800',
                        'bg-zinc-800',
                        'bg-neutral-800',
                        'bg-stone-800',
                        'bg-gray-800',
                        'bg-slate-700',
                        'bg-zinc-700',
                        'bg-neutral-700',
                        'bg-stone-700',
                    ];
                @endphp

                @forelse($weapons as $index => $weapon)
                    <!-- Weapon Item {{ $index + 1 }} -->
                    <div class="relative overflow-hidden shadow-lg cursor-pointer group rounded-xl md:rounded-2xl card-hover animate-scaleIn weapon-card"
                        data-weapon-id="{{ $weapon->id }}" data-weapon-name="{{ $weapon->name }}"
                        style="animation-delay: {{ $index * 100 }}ms">
                        <div
                            class="flex items-center justify-center h-48 aspect-w-16 aspect-h-9 {{ $cardBackgrounds[$index % count($cardBackgrounds)] }} border border-white/10 md:h-64">
                            <div class="text-center">
                                <h2
                                    class="text-4xl font-bold text-white transition duration-300 md:text-5xl lg:text-6xl group-hover:scale-110">
                                    {{ $weapon->name }}
                                </h2>
                            </div>
                        </div>
                        <!-- Always visible weapon name at bottom -->
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 transition duration-300 border-t bg-black/80 border-white/10 md:p-6">
                            {{-- <h3 class="mb-1 text-xl font-bold text-white md:text-2xl">{{ $weapon->name }}</h3> --}}
                            <p class="text-sm text-gray-300 md:text-base">{{ $weapon->skins_count }} Skins</p>
                        </div>
                        <!-- Hover overlay with button -->
                        <div
                            class="absolute inset-0 flex items-center justify-center transition duration-300 bg-black bg-opacity-0 group-hover:bg-opacity-60">
                            <button
                                class="px-6 py-3 text-sm font-semibold text-white transition transform scale-90 bg-red-600 rounded-lg opacity-0 md:text-base group-hover:opacity-100 group-hover:scale-100 hover:bg-red-700 hover:shadow-lg hover:shadow-red-500/40">
                                <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat Koleksi
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="p-8 text-center bg-gray-800 border border-gray-700 rounded-lg">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="mb-2 text-xl font-bold text-gray-300">Belum Ada Data Weapon</h3>
                            <p class="text-gray-400">Silakan tambahkan data weapon terlebih dahulu</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Skins Modal -->
    <div id="skinsModal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black bg-opacity-75">
        <div class="relative w-full max-w-6xl max-h-screen overflow-hidden bg-gray-800 rounded-2xl">
            <!-- Modal Header -->
            <div
                class="sticky top-0 z-10 flex items-center justify-between p-4 border-b md:p-6 bg-gradient-to-r from-red-600 to-red-700 border-red-500/20">
                <div>
                    <h3 id="modalWeaponName" class="text-2xl font-bold text-white md:text-3xl">Loading...</h3>
                    <p id="modalSkinsCount" class="text-sm text-red-100 md:text-base">Memuat data...</p>
                </div>
                <button id="closeModal" class="p-2 text-white transition rounded-lg hover:bg-red-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 overflow-y-auto md:p-6" style="max-height: calc(100vh - 200px)">
                <div id="skinsContainer" class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 md:gap-6">
                    <!-- Loading State -->
                    <div class="flex items-center justify-center col-span-full">
                        <div class="text-center">
                            <svg class="w-12 h-12 mx-auto text-red-500 animate-spin" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <p class="mt-4 text-gray-300">Memuat skins...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prediction Detail Modal -->
    <div id="predictionDetailModal" class="fixed inset-0 z-[90] hidden p-4 bg-black/60 backdrop-blur-sm">
        <div class="flex items-start justify-center w-full min-h-full pt-20 pb-6 md:pt-24">
            <div
                class="relative w-[90vw] max-w-2xl max-h-[calc(100vh-7rem)] overflow-y-auto bg-gray-800 border border-gray-700 rounded-2xl shadow-2xl shadow-black/50">
                <div
                    class="flex items-start justify-between p-6 border-b bg-gradient-to-r from-cyan-700 to-cyan-900 border-cyan-500/30">
                    <div>
                        <h4 id="predictionDetailTitle" class="text-2xl font-extrabold text-white">Detail Skin</h4>
                    </div>
                    <button id="closePredictionDetailModal"
                        class="p-2 text-white transition rounded-lg hover:bg-cyan-800/70">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-6">
                    <div class="max-w-xl mx-auto text-center">
                        <div class="overflow-hidden border border-gray-700 rounded-xl bg-gray-900/60">
                            <img id="predictionDetailImage" src="" alt="Skin Image"
                                class="object-contain w-full h-[260px] max-h-[300px]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mt-6 text-sm md:grid-cols-2">
                        <div class="space-y-3">
                            <p class="text-gray-300">Senjata: <span id="predictionDetailWeapon"
                                    class="font-semibold text-white">-</span></p>
                            <p class="text-gray-300">Harga: <span id="predictionDetailPrice"
                                    class="font-semibold text-white">-</span></p>
                            <p class="text-gray-300">Cocok: <span id="predictionDetailMatch"
                                    class="font-bold text-emerald-400">-</span></p>
                        </div>
                        <div class="space-y-3">
                            <p class="text-gray-300">Kelangkaan: <span id="predictionDetailRarity"
                                    class="font-semibold text-white">-</span></p>
                            <p class="text-gray-300">VFX: <span id="predictionDetailVfx"
                                    class="font-semibold text-white">-</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Me Section -->
    <section id="aboutme" class="min-h-screen py-20 bg-gradient-to-br from-gray-800 via-gray-900 to-black">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-16 text-center animate-fadeInUp">
                <h2 class="mb-4 text-4xl font-bold text-gray-100 md:text-5xl">
                    About <span class="gradient-text">Me</span>
                </h2>
                <p class="text-xl text-gray-300">Mengenal lebih dekat tentang proyek ini</p>
            </div>

            <div class="grid items-center gap-12 md:grid-cols-2">
                <div class="space-y-6 animate-slideInLeft">
                    <h3 class="text-3xl font-bold text-gray-100">Valorant Prediksi Platform</h3>
                    <p class="text-lg leading-relaxed text-gray-300">
                        Platform prediksi skin Valorant yang menggunakan teknologi machine learning untuk memberikan
                        analisis mendalam tentang tren skin, popularitas, dan rekomendasi berdasarkan data historis.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-300">
                        Dikembangkan dengan passion untuk gaming dan data science, kami berkomitmen untuk memberikan
                        pengalaman terbaik bagi para pemain Valorant dalam memilih skin favorit mereka.
                    </p>

                    <div class="pt-4 space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-500/20">
                                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-100">Machine Learning Powered</h4>
                                <p class="text-gray-300">Menggunakan algoritma ML untuk prediksi akurat</p>
                            </div>
                        </div>

                        {{-- <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-cyan-500/20">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            {{-- <div>
                                <h4 class="text-lg font-semibold text-gray-100">Real-time Updates</h4>
                                <p class="text-gray-300">Data selalu up-to-date dengan database terkini</p>
                            </div> --}}
                        {{-- </div>  --}}

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-400/20">
                                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-100">User Friendly</h4>
                                <p class="text-gray-300">Interface yang mudah digunakan untuk semua kalangan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative animate-slideInRight">
                    <div class="p-8 bg-gray-800 border border-gray-700 shadow-2xl rounded-2xl">
                        <div class="space-y-6">
                            <div>
                                <h4 class="mb-2 text-lg font-semibold text-gray-100">Teknologi</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="px-4 py-2 text-sm font-medium text-red-400 rounded-full bg-red-500/20">Laravel</span>
                                    <span
                                        class="px-4 py-2 text-sm font-medium rounded-full bg-cyan-500/20 text-cyan-400">TailwindCSS</span>
                                    <span
                                        class="px-4 py-2 text-sm font-medium text-red-300 rounded-full bg-red-400/20">Machine
                                        Learning</span>
                                    <span
                                        class="px-4 py-2 text-sm font-medium rounded-full bg-cyan-400/20 text-cyan-300">MySQL</span>
                                </div>
                            </div>

                            <div>
                                <h4 class="mb-2 text-lg font-semibold text-gray-100">Fitur Utama</h4>
                                <ul class="space-y-2 text-gray-300">
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Analisis Skin Terpopuler
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Analisis Tren Bulanan
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Rekomendasi Personal
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Database Lengkap
                                    </li>
                                </ul>
                            </div>

                            <div class="pt-4">
                                <button
                                    class="w-full px-6 py-3 font-semibold text-white transition duration-300 transform rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:shadow-lg hover:shadow-red-500/50 hover:scale-105">
                                    Hubungi Kami
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 text-white bg-gray-900">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-3">
                <div>
                    <h3 class="mb-4 text-2xl font-bold gradient-text">Valorant Prediksi</h3>
                    <p class="text-gray-400">Platform prediksi skin Valorant terbaik dengan teknologi machine learning.
                    </p>
                </div>

                <div>
                    <h4 class="mb-4 text-lg font-semibold">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 transition hover:text-white">Beranda</a></li>
                        <li><a href="#gallery" class="text-gray-400 transition hover:text-white">Gallery</a></li>
                        <li><a href="#aboutme" class="text-gray-400 transition hover:text-white">About Me</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4 text-lg font-semibold">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="flex items-center justify-center w-10 h-10 transition bg-gray-800 rounded-full hover:bg-red-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="flex items-center justify-center w-10 h-10 transition bg-gray-800 rounded-full hover:bg-red-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="flex items-center justify-center w-10 h-10 transition bg-gray-800 rounded-full hover:bg-red-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="pt-8 mt-8 text-center text-gray-400 border-t border-gray-800">
                <p>&copy; 2025 Valorant Prediksi. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    mobileMenu.classList.add('hidden');
                }
            });
        });

        // Update active nav link on scroll
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                }
            });
        }, observerOptions);

        document.querySelectorAll('[class*="animate-"]').forEach((el) => {
            el.style.opacity = '0';
            observer.observe(el);
        });

        // Generate Data Form Handler
        const generateDataForm = document.getElementById('generateDataForm');
        const progressSection = document.getElementById('progressSection');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        const resultSection = document.getElementById('resultSection');
        const resultText = document.getElementById('resultText');
        const resetBtn = document.getElementById('resetBtn');
        const tryAgainBtn = document.getElementById('tryAgainBtn');
        const openRawGeneratorBtn = document.getElementById('openRawGeneratorBtn');
        const closeRawGeneratorBtn = document.getElementById('closeRawGeneratorBtn');
        const rawGeneratorBackdrop = document.getElementById('rawGeneratorBackdrop');
        const rawGeneratorPanel = document.getElementById('rawGeneratorPanel');
        const rawGenerateForm = document.getElementById('rawGenerateForm');
        const rawResetBtn = document.getElementById('rawResetBtn');
        const rawProgressSection = document.getElementById('rawProgressSection');
        const rawProgressBar = document.getElementById('rawProgressBar');
        const rawProgressText = document.getElementById('rawProgressText');
        const rawResultSection = document.getElementById('rawResultSection');
        const rawResultText = document.getElementById('rawResultText');
        const predictionDetailModal = document.getElementById('predictionDetailModal');
        const closePredictionDetailModalBtn = document.getElementById('closePredictionDetailModal');
        const predictionDetailTitle = document.getElementById('predictionDetailTitle');
        const predictionDetailImage = document.getElementById('predictionDetailImage');
        const predictionDetailWeapon = document.getElementById('predictionDetailWeapon');
        const predictionDetailRarity = document.getElementById('predictionDetailRarity');
        const predictionDetailPrice = document.getElementById('predictionDetailPrice');
        const predictionDetailVfx = document.getElementById('predictionDetailVfx');
        const predictionDetailMatch = document.getElementById('predictionDetailMatch');
        let latestRecommendationList = [];

        const escapeHtml = (text) => String(text)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#39;');

        const sanitizeSkinInputLine = (text) => String(text)
            .replaceAll('&quot;', '"')
            .replaceAll('&#34;', '"')
            .replaceAll('&apos;', "'")
            .replaceAll('&#39;', "'")
            .replace(/<[^>]*>/g, ' ')
            .replace(/["']/g, ' ')
            .replace(/\s+/g, ' ')
            .trim();

        const normalizeSkinKey = (text) => sanitizeSkinInputLine(text)
            .toLowerCase()
            .replace(/\s+/g, ' ')
            .trim();

        function openPredictionDetailModal(item) {
            predictionDetailTitle.textContent = item.skin_name ?? item.name ?? 'Unnamed Skin';

            if (item.image_url) {
                predictionDetailImage.src = item.image_url;
                predictionDetailImage.alt = item.skin_name ?? 'Skin Image';
            } else {
                predictionDetailImage.src = 'https://via.placeholder.com/640x360?text=No+Image';
                predictionDetailImage.alt = 'No Image';
            }

            predictionDetailWeapon.textContent = item.weapon ?? '-';
            predictionDetailRarity.textContent = item.rarity_name ?? item.rarity ?? '-';
            predictionDetailPrice.textContent = item.price ?? '-';
            predictionDetailVfx.textContent = item.vfx ?? '-';
            predictionDetailMatch.textContent = item.match_percentage ??
                (item.similarity_score !== undefined ? `${Number(item.similarity_score).toFixed(1)}%` : '-');

            predictionDetailModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePredictionDetailModal() {
            predictionDetailModal.classList.add('hidden');
            predictionDetailImage.src = '';
            document.body.style.overflow = 'auto';
        }

        function openRawGenerator() {
            rawGeneratorBackdrop.classList.remove('hidden');
            rawGeneratorPanel.classList.remove('translate-x-full');
            document.body.style.overflow = 'hidden';
        }

        function closeRawGenerator() {
            rawGeneratorPanel.classList.add('translate-x-full');
            rawGeneratorBackdrop.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        if (openRawGeneratorBtn) {
            openRawGeneratorBtn.addEventListener('click', openRawGenerator);
        }

        if (closeRawGeneratorBtn) {
            closeRawGeneratorBtn.addEventListener('click', closeRawGenerator);
        }

        if (rawGeneratorBackdrop) {
            rawGeneratorBackdrop.addEventListener('click', closeRawGenerator);
        }

        generateDataForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            latestRecommendationList = [];

            // Validate form
            if (!generateDataForm.checkValidity()) {
                generateDataForm.reportValidity();
                return;
            }

            // Get form data
            const formData = new FormData(generateDataForm);
            const weapon = formData.get('weapon');
            const price = formData.get('price');
            const vfx = formData.get('vfx');
            const rarity = formData.get('rarity');

            // Hide result section if visible
            resultSection.classList.add('hidden');

            // Show progress section
            progressSection.classList.remove('hidden');
            progressBar.style.width = '0%';
            progressText.textContent = 'Menginisialisasi model...';

            // Simulate prediction process
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress > 90) progress = 90;

                progressBar.style.width = progress + '%';

                if (progress < 30) {
                    progressText.textContent = 'Memproses parameter input...';
                } else if (progress < 60) {
                    progressText.textContent = 'Menjalankan model prediksi...';
                } else if (progress < 90) {
                    progressText.textContent = 'Menganalisis hasil...';
                }
            }, 200);

            try {
                progressText.textContent = 'Mengirim request ke server...';

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch('/recommend', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        weapon,
                        price,
                        vfx,
                        rarity,
                        top_n: 10,
                    }),
                });

                const result = await response.json();
                clearInterval(interval);
                progressBar.style.width = '100%';
                progressText.textContent = 'Prediksi selesai!';

                if (!response.ok || result.success !== true) {
                    throw new Error(result.message || 'Gagal mengambil rekomendasi dari server');
                }

                const recommendations = result.recommendations ?? [];
                const recommendationList = Array.isArray(recommendations) ? recommendations : [];
                latestRecommendationList = recommendationList;

                let autoSaveMessage;
                if (result.history_saved === true) {
                    autoSaveMessage =
                        '<div class="p-3 text-sm text-green-300 border rounded-lg bg-green-900/20 border-green-500/40">Prediksi berhasil dan otomatis tersimpan ke database.</div>';
                } else {
                    autoSaveMessage =
                        `<div class="p-3 text-sm text-yellow-300 border rounded-lg bg-yellow-900/20 border-yellow-500/40">Prediksi berhasil, tetapi auto-save gagal: ${escapeHtml(result.history_save_error || 'Silakan coba lagi.')}</div>`;
                }

                setTimeout(() => {
                    progressSection.classList.add('hidden');
                    resultSection.classList.remove('hidden');

                    if (recommendationList.length > 0) {
                        resultText.innerHTML = `
                            <div>
                                <h5 class="mb-3 text-xl font-bold text-green-400">Top ${recommendationList.length} Rekomendasi Skin</h5>
                                <div class="mb-3">${autoSaveMessage}</div>
                                <div class="space-y-2 text-gray-100">
                                    ${recommendationList.map((item, index) => `
                                                                                                                <div class="flex items-start justify-between p-3 bg-gray-900 border border-gray-700 rounded-lg">
                                                                                                                    <div class="pr-3">
                                                                                                                        <p class="font-semibold text-white">#${index + 1} ${item.skin_name ?? item.name ?? 'Unnamed Skin'}</p>
                                                                                                                        <p class="text-xs text-gray-400">Weapon: ${item.weapon ?? '-'} | ${item.rarity_name ?? 'Rarity -'}</p>
                                                                                                                        <p class="text-xs text-gray-400">Price: ${item.price ?? '-'} | VFX: ${item.vfx ?? '-'} | Rarity: ${item.rarity ?? '-'}</p>
                                                                                                                        <button type="button" class="inline-flex items-center px-3 py-1 mt-2 text-xs font-semibold text-white transition rounded-lg prediction-detail-btn bg-cyan-600 hover:bg-cyan-700" data-index="${index}">
                                                                                                                            Detail
                                                                                                                        </button>
                                                                                                                    </div>
                                                                                                                    <div class="text-right">
                                                                                                                        <p class="text-sm font-semibold text-cyan-400">${item.match_percentage ?? (item.similarity_score !== undefined ? `${Number(item.similarity_score).toFixed(1)}%` : '-')}</p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            `).join('')}
                                </div>
                            </div>
                        `;
                    } else {
                        resultText.innerHTML = `
                            <div class="mb-3">${autoSaveMessage}</div>
                            <div class="p-3 text-sm text-yellow-300 border rounded-lg bg-yellow-900/20 border-yellow-500/40">
                                Response diterima, tapi tidak ada data rekomendasi yang bisa ditampilkan.
                            </div>
                        `;
                    }

                    resultSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 300);
            } catch (error) {
                clearInterval(interval);
                progressSection.classList.add('hidden');
                resultSection.classList.remove('hidden');
                resultText.innerHTML = `
                    <div class="p-3 text-sm text-red-300 border rounded-lg bg-red-900/20 border-red-500/40">
                        ${error.message}
                    </div>
                `;
            }
        });

        // Reset button handler
        resetBtn.addEventListener('click', () => {
            generateDataForm.reset();
            progressSection.classList.add('hidden');
            resultSection.classList.add('hidden');
            progressBar.style.width = '0%';
        });

        // Try Again button handler
        if (tryAgainBtn) {
            tryAgainBtn.addEventListener('click', () => {
                resultSection.classList.add('hidden');
                generateDataForm.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        }

        if (rawGenerateForm) {
            rawGenerateForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                if (!rawGenerateForm.checkValidity()) {
                    rawGenerateForm.reportValidity();
                    return;
                }

                const formData = new FormData(rawGenerateForm);
                const availableSkinsInput = String(formData.get('available_skins_raw') || '')
                    .replaceAll('&#10;', '\n')
                    .replaceAll('\r\n', '\n');
                const availableSkins = availableSkinsInput
                    .split('\n')
                    .map(item => sanitizeSkinInputLine(item))
                    .filter(Boolean);

                const uniqueAvailableSkins = [...new Set(availableSkins)];

                if (availableSkins.length === 0) {
                    rawResultSection.classList.remove('hidden');
                    rawResultText.innerHTML =
                        '<div class="p-3 text-sm text-red-300 border rounded-lg bg-red-900/20 border-red-500/40">Minimal isi satu nama skin di kolom Available Skins.</div>';
                    return;
                }

                rawResultSection.classList.add('hidden');
                rawProgressSection.classList.remove('hidden');
                rawProgressBar.style.width = '20%';
                rawProgressText.textContent = 'Menyiapkan payload raw...';

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    rawProgressBar.style.width = '60%';
                    rawProgressText.textContent = 'Mengirim request raw ke server...';

                    const response = await fetch('/recommend/raw', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            available_skins: uniqueAvailableSkins,
                            price: Number(formData.get('price')),
                            rarity: Number(formData.get('rarity')),
                            vfx: Number(formData.get('vfx')),
                        }),
                    });

                    const result = await response.json();
                    rawProgressBar.style.width = '100%';
                    rawProgressText.textContent = 'Selesai';

                    if (!response.ok || result.success === false) {
                        throw new Error(result.message || 'Gagal mengambil rekomendasi raw dari server');
                    }

                    const recommendations = result.recommendations ?? result.data?.recommendations ?? [];
                    const allowedSkinKeys = new Set(uniqueAvailableSkins.map(item => normalizeSkinKey(item)));
                    const filteredRecommendations = Array.isArray(recommendations) ?
                        recommendations.filter((item) => {
                            const candidateName = item.skin_name ?? item.name ?? '';
                            return allowedSkinKeys.has(normalizeSkinKey(candidateName));
                        }) : [];

                    rawResultSection.classList.remove('hidden');
                    if (filteredRecommendations.length > 0) {
                        rawResultText.innerHTML = `
                            <div>
                                <h6 class="mb-2 font-semibold text-cyan-300">Top ${filteredRecommendations.length} Rekomendasi</h6>
                                <div class="space-y-2">
                                    ${filteredRecommendations.map((item, index) => `
                                                                                            <div class="p-3 bg-gray-900 border border-gray-700 rounded-lg">
                                                                                                <p class="font-semibold text-white">#${index + 1} ${escapeHtml(item.skin_name ?? item.name ?? 'Unnamed Skin')}</p>
                                                                                                <p class="text-xs text-gray-400">Weapon: ${escapeHtml(item.weapon ?? '-')} | Rarity: ${escapeHtml(item.rarity_name ?? item.rarity ?? '-')}</p>
                                                                                                <p class="text-xs text-gray-400">Score: ${escapeHtml(item.match_percentage ?? item.predicted_score ?? item.similarity_score ?? '-')}</p>
                                                                                            </div>
                                                                                        `).join('')}
                                </div>
                            </div>
                        `;
                    } else {
                        const hasNotFoundSkins = Array.isArray(result.not_found_skins) && result.not_found_skins
                            .length > 0;
                        const hasOutOfListRecommendations = Array.isArray(recommendations) && recommendations
                            .length > 0 && filteredRecommendations.length === 0;
                        const invalidInputMessage = hasNotFoundSkins ?
                            'Input skin tidak cocok dengan data model. Pastikan nama skin sesuai store Valorant Anda dan isi satu nama per baris.' :
                            (hasOutOfListRecommendations ?
                                'Hasil model berada di luar daftar input raw, jadi tidak ditampilkan. Cek kembali nama skin yang Anda masukkan.' :
                                'Input tidak valid atau tidak ada rekomendasi. Cek kembali format input Anda.');

                        rawResultText.innerHTML = `
                            <div class="p-3 text-sm text-yellow-300 border rounded-lg bg-yellow-900/20 border-yellow-500/40">
                                ${escapeHtml(invalidInputMessage)}
                            </div>
                        `;
                    }
                } catch (error) {
                    rawResultSection.classList.remove('hidden');
                    rawResultText.innerHTML =
                        `<div class="p-3 text-sm text-red-300 border rounded-lg bg-red-900/20 border-red-500/40">${escapeHtml(error.message)}</div>`;
                } finally {
                    setTimeout(() => {
                        rawProgressSection.classList.add('hidden');
                        rawProgressBar.style.width = '0%';
                    }, 300);
                }
            });
        }

        if (rawResetBtn) {
            rawResetBtn.addEventListener('click', () => {
                rawGenerateForm.reset();
                rawProgressSection.classList.add('hidden');
                rawResultSection.classList.add('hidden');
                rawProgressBar.style.width = '0%';
            });
        }

        if (resultText) {
            resultText.addEventListener('click', (event) => {
                const detailButton = event.target.closest('.prediction-detail-btn');
                if (!detailButton) {
                    return;
                }

                const index = Number(detailButton.dataset.index);
                if (!Number.isInteger(index) || !latestRecommendationList[index]) {
                    return;
                }

                openPredictionDetailModal(latestRecommendationList[index]);
            });
        }

        if (closePredictionDetailModalBtn) {
            closePredictionDetailModalBtn.addEventListener('click', closePredictionDetailModal);
        }

        if (predictionDetailModal) {
            predictionDetailModal.addEventListener('click', function(e) {
                if (e.target === predictionDetailModal) {
                    closePredictionDetailModal();
                }
            });
        }

        // Weapon Gallery & Skins Modal Handler
        const skinsModal = document.getElementById('skinsModal');
        const closeModalBtn = document.getElementById('closeModal');
        const weaponCards = document.querySelectorAll('.weapon-card');

        // Open modal and fetch skins when weapon card is clicked
        weaponCards.forEach(card => {
            card.addEventListener('click', async function() {
                const weaponId = this.dataset.weaponId;
                const weaponName = this.dataset.weaponName;

                // Show modal
                skinsModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                // Update modal header
                document.getElementById('modalWeaponName').textContent = weaponName;
                document.getElementById('modalSkinsCount').textContent = 'Memuat data...';

                // Show loading state
                const skinsContainer = document.getElementById('skinsContainer');
                skinsContainer.innerHTML = `
                    <div class="flex items-center justify-center py-12 col-span-full">
                        <div class="text-center">
                            <svg class="w-12 h-12 mx-auto text-red-500 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <p class="mt-4 text-gray-300">Memuat skins...</p>
                        </div>
                    </div>
                `;

                try {
                    // Fetch skins from API
                    const response = await fetch(`/api/weapons/${weaponId}/skins`);
                    const data = await response.json();

                    if (data.success) {
                        // Update skins count
                        document.getElementById('modalSkinsCount').textContent =
                            `${data.skins.length} Skins Tersedia`;

                        // Display skins
                        if (data.skins.length > 0) {
                            skinsContainer.innerHTML = data.skins.map((skin, index) => `
                                <div class="overflow-hidden transition duration-300 bg-gray-700 shadow-lg rounded-xl hover:shadow-2xl hover:shadow-red-500/20 hover:scale-105"
                                     style="animation: scaleIn 0.5s ease-out ${index * 50}ms both">
                                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-600 to-gray-800">
                                        ${skin.image_url
                                            ? `<img src="${skin.image_url}" alt="${skin.skin_name}" class="object-cover w-full h-full transition duration-300 hover:scale-110">`
                                            : `<div class="flex items-center justify-center h-full">
                                                                                                                                            <svg class="w-20 h-20 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                                                                                            </svg>
                                                                                                                                           </div>`
                                        }
                                        ${skin.rarity
                                            ? `<div class="absolute px-3 py-1 text-xs font-semibold text-white rounded-full top-2 right-2 bg-gradient-to-r from-yellow-500 to-orange-500">
                                                                                                                                            ${skin.rarity}
                                                                                                                                           </div>`
                                            : ''
                                        }
                                    </div>
                                    <div class="p-4">
                                        <h4 class="mb-2 text-lg font-bold text-white line-clamp-2">${skin.skin_name || 'Unnamed Skin'}</h4>
                                        <div class="flex items-center justify-between mb-3">
                                            ${skin.price
                                                ? `<span class="flex items-center text-sm font-semibold text-red-400">
                                                                                                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                                                                                                </svg>
                                                                                                                                                ${skin.price} VP
                                                                                                                                               </span>`
                                                : '<span class="text-sm text-gray-400">Free</span>'
                                            }
                                            ${skin.vfx && isNaN(skin.vfx)
                                                ? `<span class="px-2 py-1 text-xs font-medium rounded-full bg-cyan-500/20 text-cyan-400">
                                                                                                                                                ${skin.vfx}
                                                                                                                                               </span>`
                                                : ''
                                            }
                                        </div>
                                        ${skin.popularity
                                            ? `<div class="flex items-center mt-2">
                                                                                                                                            <span class="mr-2 text-xs text-gray-400">Popularity:</span>
                                                                                                                                            <div class="flex-1 h-2 overflow-hidden bg-gray-600 rounded-full">
                                                                                                                                                <div class="h-full transition-all duration-500 bg-gradient-to-r from-red-500 to-red-600"
                                                                                                                                                     style="width: ${Math.min(100, parseFloat(skin.popularity))}%"></div>
                                                                                                                                            </div>
                                                                                                                                            <span class="ml-2 text-xs font-semibold text-gray-300">${parseFloat(skin.popularity).toFixed(1)}%</span>
                                                                                                                                           </div>`
                                            : ''
                                        }
                                        ${skin.score
                                            ? `<div class="flex items-center justify-between mt-2 text-xs">
                                                                                                                                            <span class="text-gray-400">Rating Score:</span>
                                                                                                                                            <span class="font-semibold text-yellow-400">${parseFloat(skin.score).toFixed(2)}</span>
                                                                                                                                           </div>`
                                            : ''
                                        }
                                    </div>
                                </div>
                            `).join('');
                        } else {
                            skinsContainer.innerHTML = `
                                <div class="col-span-full">
                                    <div class="p-12 text-center bg-gray-700 rounded-lg">
                                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <h3 class="mb-2 text-xl font-bold text-gray-300">Belum Ada Skin</h3>
                                        <p class="text-gray-400">Skin untuk weapon ini belum tersedia</p>
                                    </div>
                                </div>
                            `;
                        }
                    }
                } catch (error) {
                    console.error('Error fetching skins:', error);
                    skinsContainer.innerHTML = `
                        <div class="col-span-full">
                            <div class="p-12 text-center border rounded-lg bg-red-900/20 border-red-500/30">
                                <svg class="w-16 h-16 mx-auto mb-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="mb-2 text-xl font-bold text-red-400">Gagal Memuat Data</h3>
                                <p class="text-gray-300">Terjadi kesalahan saat mengambil data skins</p>
                            </div>
                        </div>
                    `;
                }
            });
        });

        // Close modal
        function closeModal() {
            skinsModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        closeModalBtn.addEventListener('click', closeModal);

        // Close modal when clicking outside
        skinsModal.addEventListener('click', function(e) {
            if (e.target === skinsModal) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (!skinsModal.classList.contains('hidden')) {
                    closeModal();
                }
                if (predictionDetailModal && !predictionDetailModal.classList.contains('hidden')) {
                    closePredictionDetailModal();
                }
            }
        });
    </script>
</body>

</html>
