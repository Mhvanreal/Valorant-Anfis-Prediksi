<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Valorant Prediksi - Landing Page</title>

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
    </style>
</head>

<body class="antialiased bg-gray-900">
    <!-- Navigation -->
    <nav class="fixed w-full bg-gray-900/95 backdrop-blur-md shadow-lg border-b border-red-500/20 z-50 animate-fadeIn">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <h1 class="text-xl md:text-2xl font-bold gradient-text">Valorant Prediksi</h1>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#beranda" class="nav-link active text-gray-200 hover:text-red-500 font-medium">Beranda</a>
                    <a href="#gallery" class="nav-link text-gray-200 hover:text-red-500 font-medium">Gallery</a>
                    <a href="#aboutme" class="nav-link text-gray-200 hover:text-red-500 font-medium">About Me</a>
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-red-500/50 transform hover:scale-105 transition duration-300">
                        Sign In
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-200 hover:text-red-500 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-gray-800 border-t border-red-500/20">
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
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-black pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">
                <div class="space-y-4 md:space-y-6">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white animate-slideInLeft">
                        Welcome to <span class="gradient-text">Valorant Prediksi</span>
                    </h2>
                    <p class="text-base md:text-xl text-gray-300 animate-slideInLeft delay-200">
                        Prediksi skin Valorant terbaik dengan teknologi machine learning dan analisis data terkini.
                    </p>
                    {{-- <div class="flex gap-4 animate-slideInLeft delay-300">
                        <button
                            class="px-8 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition duration-300">
                            Get Started
                        </button>
                        <button
                            class="px-8 py-3 border-2 border-purple-600 text-purple-600 rounded-lg font-semibold hover:bg-purple-50 transition duration-300">
                            Learn More
                        </button>
                    </div> --}}
                </div>

                <div class="relative animate-slideInRight">
                    <div
                        class="w-full h-64 md:h-96 bg-gradient-to-br from-red-600 via-red-500 to-gray-900 rounded-2xl shadow-2xl shadow-red-500/50 floating">
                    </div>
                    <div class="absolute top-2 right-2 w-16 h-16 md:w-24 md:h-24 bg-cyan-400 rounded-full opacity-75">
                    </div>
                    <div class="absolute bottom-2 left-2 w-20 h-20 md:w-32 md:h-32 bg-red-400 rounded-full opacity-75">
                    </div>
                </div>
            </div>

            <!-- Generate Data Section -->
            <div class="mt-12 md:mt-20 animate-fadeInUp delay-300">
                <div
                    class="bg-gray-800 border border-red-500/20 rounded-xl md:rounded-2xl shadow-2xl shadow-red-500/10 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 p-4 md:p-6">
                        <h3 class="text-lg md:text-2xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 md:w-8 md:h-8 mr-2 md:mr-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                            Generate Data Training
                        </h3>
                        <p class="text-sm md:text-base text-red-100 mt-1 md:mt-2">Generate dataset untuk melatih model
                            prediksi skin Valorant</p>
                    </div>

                    <div class="p-4 md:p-8">
                        <form id="generateDataForm" class="space-y-4 md:space-y-6">
                            <!-- Input Parameters Grid -->
                            <div class="grid md:grid-cols-2 gap-4 md:gap-6">
                                <!-- Harga -->
                                <div class="space-y-1.5 md:space-y-2">
                                    <label for="price"
                                        class="block text-xs md:text-sm font-semibold text-gray-200 flex items-center">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-red-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Harga (VP)
                                    </label>
                                    <input type="number" id="price" name="price" required
                                        class="w-full px-3 py-2 md:px-4 md:py-3 text-sm md:text-base bg-gray-700 border-2 border-gray-600 text-white rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-500/50 outline-none transition"
                                        placeholder="Contoh: 2175" min="0" max="10000" step="1">
                                    <p class="text-xs text-gray-400">Range: 0 - 10,000 VP</p>
                                </div>

                                <!-- Efek Visual -->
                                <div class="space-y-1.5 md:space-y-2">
                                    <label for="visualEffect"
                                        class="block text-xs md:text-sm font-semibold text-gray-200 flex items-center">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-cyan-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                        Efek Visual
                                    </label>
                                    <select id="visualEffect" name="visualEffect" required
                                        class="w-full px-3 py-2 md:px-4 md:py-3 text-sm md:text-base bg-gray-700 border-2 border-gray-600 text-white rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-500/50 outline-none transition">
                                        <option value="">-- Pilih Efek Visual --</option>
                                        <option value="none">Tanpa Efek</option>
                                        <option value="standard">Standard VFX</option>
                                        <option value="premium">Premium VFX</option>
                                        <option value="finisher">VFX + Finisher</option>
                                        <option value="evolving">Evolving VFX</option>
                                        <option value="reactive">Reactive VFX</option>
                                    </select>
                                </div>

                                <!-- Rarity -->
                                <div class="space-y-1.5 md:space-y-2">
                                    <label for="rarity"
                                        class="block text-xs md:text-sm font-semibold text-gray-200 flex items-center">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-yellow-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        Rarity
                                    </label>
                                    <select id="rarity" name="rarity" required
                                        class="w-full px-3 py-2 md:px-4 md:py-3 text-sm md:text-base bg-gray-700 border-2 border-gray-600 text-white rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-500/50 outline-none transition">
                                        <option value="">-- Pilih Rarity --</option>
                                        <option value="select">Select Edition</option>
                                        <option value="deluxe">Deluxe Edition</option>
                                        <option value="premium">Premium Edition</option>
                                        <option value="exclusive">Exclusive Edition</option>
                                        <option value="ultra">Ultra Edition</option>
                                    </select>
                                </div>

                                <!-- Popularity -->
                                <div class="space-y-1.5 md:space-y-2">
                                    <label for="popularity"
                                        class="block text-xs md:text-sm font-semibold text-gray-200 flex items-center">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 text-red-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                        Popularity Score
                                    </label>
                                    <input type="number" id="popularity" name="popularity" required
                                        class="w-full px-3 py-2 md:px-4 md:py-3 text-sm md:text-base bg-gray-700 border-2 border-gray-600 text-white rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-500/50 outline-none transition"
                                        placeholder="Contoh: 85" min="0" max="100" step="0.1">
                                    <p class="text-xs text-gray-400">Range: 0 - 100 (semakin tinggi semakin populer)
                                    </p>
                                </div>
                            </div>

                            <!-- Info Card -->
                            <div
                                class="bg-gradient-to-r from-gray-700 to-gray-800 border-l-4 border-red-500 p-3 md:p-4 rounded-lg">
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 text-red-500 mr-2 md:mr-3 flex-shrink-0 mt-0.5"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <p class="text-xs md:text-sm font-medium text-gray-100">Parameter Prediksi</p>
                                        <p class="text-xs text-gray-300 mt-1">Model akan memprediksi tingkat kesukaan
                                            skin berdasarkan 4 parameter yang Anda masukkan: Harga, Efek Visual, Rarity,
                                            dan Popularity Score.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2 md:gap-4 pt-3 md:pt-4">
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
                            </div>
                        </form>

                        <!-- Progress Bar (Hidden by default) -->
                        <div id="progressSection" class="hidden mt-4 md:mt-6">
                            <div class="bg-gray-700 rounded-full h-3 md:h-4 overflow-hidden">
                                <div id="progressBar"
                                    class="bg-gradient-to-r from-red-600 to-red-700 h-full transition-all duration-500"
                                    style="width: 0%"></div>
                            </div>
                            <p id="progressText" class="text-center text-sm text-gray-300 mt-2">Generating data...</p>
                        </div>

                        <!-- Result Section (Hidden by default) -->
                        <div id="resultSection"
                            class="hidden mt-4 md:mt-6 p-4 md:p-6 bg-gradient-to-r from-gray-700 to-gray-800 border-2 border-green-500 rounded-lg shadow-lg shadow-green-500/20">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 md:w-8 md:h-8 text-green-600 mr-2 md:mr-3 flex-shrink-0"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex-1">
                                    <h4
                                        class="text-base md:text-xl font-bold text-green-800 mb-2 md:mb-3 flex items-center">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-1.5 md:mr-2" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Prediksi Berhasil!
                                    </h4>
                                    <div id="resultText"
                                        class="text-sm md:text-base text-gray-100 mb-3 md:mb-4 space-y-2"></div>
                                    <div class="bg-gray-900 border border-gray-700 rounded-lg p-3 md:p-4 mb-3 md:mb-4">
                                        <h5 class="text-sm md:text-base font-semibold text-gray-200 mb-2">Parameter
                                            Input:</h5>
                                        <div id="inputSummary"
                                            class="grid grid-cols-2 gap-2 md:gap-3 text-xs md:text-sm"></div>
                                    </div>
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
                                        <button id="saveBtn"
                                            class="px-4 py-1.5 md:px-6 md:py-2 text-sm md:text-base bg-cyan-600 text-white rounded-lg font-semibold hover:bg-cyan-700 transition flex items-center">
                                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4 mr-1.5 md:mr-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                            </svg>
                                            Simpan Hasil
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="grid md:grid-cols-3 gap-4 md:gap-8 mt-12 md:mt-20">
                <div
                    class="bg-gray-800 border border-red-500/20 p-6 md:p-8 rounded-xl shadow-lg shadow-red-500/10 card-hover animate-scaleIn">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-red-500/20 rounded-full flex items-center justify-center mb-3 md:mb-4">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-red-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-100 mb-1.5 md:mb-2">Fast & Accurate</h3>
                    <p class="text-sm md:text-base text-gray-300">Prediksi cepat dan akurat menggunakan algoritma
                        terbaru</p>
                </div>

                <div
                    class="bg-gray-800 border border-cyan-400/20 p-6 md:p-8 rounded-xl shadow-lg shadow-cyan-400/10 card-hover animate-scaleIn delay-200">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-cyan-400/20 rounded-full flex items-center justify-center mb-3 md:mb-4">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-cyan-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-100 mb-1.5 md:mb-2">Secure & Reliable</h3>
                    <p class="text-sm md:text-base text-gray-300">Data aman dengan sistem keamanan tingkat tinggi</p>
                </div>

                <div
                    class="bg-gray-800 border border-red-400/20 p-6 md:p-8 rounded-xl shadow-lg shadow-red-400/10 card-hover animate-scaleIn delay-400">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-red-400/20 rounded-full flex items-center justify-center mb-3 md:mb-4">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-red-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-100 mb-1.5 md:mb-2">24/7 Support</h3>
                    <p class="text-sm md:text-base text-gray-300">Dukungan penuh kapan saja Anda membutuhkan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="min-h-screen bg-gray-900 py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 md:mb-16 animate-fadeInUp">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-100 mb-3 md:mb-4">
                    Our <span class="gradient-text">Gallery</span>
                </h2>
                <p class="text-base md:text-xl text-gray-300">Koleksi visual terbaik dari prediksi dan analisis kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
                <!-- Gallery Item 1 -->
                <div
                    class="group relative overflow-hidden rounded-xl md:rounded-2xl shadow-lg card-hover animate-scaleIn">
                    <div
                        class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-purple-400 via-pink-400 to-red-400 h-48 md:h-64">
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition duration-300 flex items-center justify-center">
                        <div
                            class="text-white text-center opacity-0 group-hover:opacity-100 transition duration-300 transform scale-90 group-hover:scale-100">
                            <h3 class="text-lg md:text-2xl font-bold mb-1 md:mb-2">Vandal Skins</h3>
                            <p class="text-xs md:text-sm">Premium Collection</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 2 -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg card-hover animate-scaleIn delay-100">
                    <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-red-600 via-red-500 to-red-700 h-64">
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition duration-300 flex items-center justify-center">
                        <div
                            class="text-white text-center opacity-0 group-hover:opacity-100 transition duration-300 transform scale-90 group-hover:scale-100">
                            <h3 class="text-2xl font-bold mb-2">Phantom Skins</h3>
                            <p class="text-sm">Elite Series</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 3 -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg card-hover animate-scaleIn delay-200">
                    <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-cyan-500 via-cyan-600 to-blue-600 h-64">
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition duration-300 flex items-center justify-center">
                        <div
                            class="text-white text-center opacity-0 group-hover:opacity-100 transition duration-300 transform scale-90 group-hover:scale-100">
                            <h3 class="text-2xl font-bold mb-2">Operator Skins</h3>
                            <p class="text-sm">Legendary Edition</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 4 -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg card-hover animate-scaleIn delay-300">
                    <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-gray-700 via-gray-800 to-gray-900 h-64">
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition duration-300 flex items-center justify-center">
                        <div
                            class="text-white text-center opacity-0 group-hover:opacity-100 transition duration-300 transform scale-90 group-hover:scale-100">
                            <h3 class="text-2xl font-bold mb-2">Knife Skins</h3>
                            <p class="text-sm">Exclusive Collection</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 5 -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg card-hover animate-scaleIn delay-400">
                    <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-red-500 via-red-600 to-pink-600 h-64">
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition duration-300 flex items-center justify-center">
                        <div
                            class="text-white text-center opacity-0 group-hover:opacity-100 transition duration-300 transform scale-90 group-hover:scale-100">
                            <h3 class="text-2xl font-bold mb-2">Sheriff Skins</h3>
                            <p class="text-sm">Special Edition</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 6 -->
                <div class="group relative overflow-hidden rounded-2xl shadow-lg card-hover animate-scaleIn delay-500">
                    <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-cyan-400 via-cyan-500 to-teal-600 h-64">
                    </div>
                    <div
                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition duration-300 flex items-center justify-center">
                        <div
                            class="text-white text-center opacity-0 group-hover:opacity-100 transition duration-300 transform scale-90 group-hover:scale-100">
                            <h3 class="text-2xl font-bold mb-2">Bundle Skins</h3>
                            <p class="text-sm">Complete Package</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Me Section -->
    <section id="aboutme" class="min-h-screen bg-gradient-to-br from-gray-800 via-gray-900 to-black py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fadeInUp">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-100 mb-4">
                    About <span class="gradient-text">Me</span>
                </h2>
                <p class="text-xl text-gray-300">Mengenal lebih dekat tentang proyek ini</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 animate-slideInLeft">
                    <h3 class="text-3xl font-bold text-gray-100">Valorant Prediksi Platform</h3>
                    <p class="text-lg text-gray-300 leading-relaxed">
                        Platform prediksi skin Valorant yang menggunakan teknologi machine learning untuk memberikan
                        analisis mendalam tentang tren skin, popularitas, dan rekomendasi berdasarkan data historis.
                    </p>
                    <p class="text-lg text-gray-300 leading-relaxed">
                        Dikembangkan dengan passion untuk gaming dan data science, kami berkomitmen untuk memberikan
                        pengalaman terbaik bagi para pemain Valorant dalam memilih skin favorit mereka.
                    </p>

                    <div class="space-y-4 pt-4">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center">
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

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-cyan-500/20 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-100">Real-time Updates</h4>
                                <p class="text-gray-300">Data selalu up-to-date dengan database terkini</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-red-400/20 rounded-full flex items-center justify-center">
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
                    <div class="bg-gray-800 border border-gray-700 p-8 rounded-2xl shadow-2xl">
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-100 mb-2">Teknologi</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="px-4 py-2 bg-red-500/20 text-red-400 rounded-full text-sm font-medium">Laravel</span>
                                    <span
                                        class="px-4 py-2 bg-cyan-500/20 text-cyan-400 rounded-full text-sm font-medium">TailwindCSS</span>
                                    <span
                                        class="px-4 py-2 bg-red-400/20 text-red-300 rounded-full text-sm font-medium">Machine
                                        Learning</span>
                                    <span
                                        class="px-4 py-2 bg-cyan-400/20 text-cyan-300 rounded-full text-sm font-medium">MySQL</span>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold text-gray-100 mb-2">Fitur Utama</h4>
                                <ul class="space-y-2 text-gray-300">
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Prediksi Skin Terpopuler
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Analisis Tren Bulanan
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Rekomendasi Personal
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor"
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
                                    class="w-full px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-semibold hover:shadow-lg hover:shadow-red-500/50 transform hover:scale-105 transition duration-300">
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
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-2xl font-bold gradient-text mb-4">Valorant Prediksi</h3>
                    <p class="text-gray-400">Platform prediksi skin Valorant terbaik dengan teknologi machine learning.
                    </p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#gallery" class="text-gray-400 hover:text-white transition">Gallery</a></li>
                        <li><a href="#aboutme" class="text-gray-400 hover:text-white transition">About Me</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
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
        const saveBtn = document.getElementById('saveBtn');

        generateDataForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Validate form
            if (!generateDataForm.checkValidity()) {
                generateDataForm.reportValidity();
                return;
            }

            // Get form data
            const formData = new FormData(generateDataForm);
            const price = formData.get('price');
            const visualEffect = formData.get('visualEffect');
            const rarity = formData.get('rarity');
            const popularity = formData.get('popularity');

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

            // Simulate API call (replace with actual API endpoint)
            setTimeout(() => {
                clearInterval(interval);
                progressBar.style.width = '100%';
                progressText.textContent = 'Prediksi selesai!';

                // Calculate prediction score (simple algorithm for demo)
                const priceScore = Math.max(0, 100 - (price / 100));
                const effectScore = {
                    'none': 20,
                    'standard': 40,
                    'premium': 60,
                    'finisher': 80,
                    'evolving': 90,
                    'reactive': 95
                } [visualEffect] || 50;

                const rarityScore = {
                    'select': 30,
                    'deluxe': 50,
                    'premium': 70,
                    'exclusive': 85,
                    'ultra': 95
                } [rarity] || 50;

                const popularityScore = parseFloat(popularity);

                // Weighted average
                const predictionScore = (
                    (priceScore * 0.2) +
                    (effectScore * 0.3) +
                    (rarityScore * 0.25) +
                    (popularityScore * 0.25)
                ).toFixed(2);

                // Determine category
                let category, categoryColor, categoryIcon;
                if (predictionScore >= 80) {
                    category = "Sangat Disukai";
                    categoryColor = "text-green-600";
                    categoryIcon = "😍";
                } else if (predictionScore >= 60) {
                    category = "Cukup Disukai";
                    categoryColor = "text-blue-600";
                    categoryIcon = "😊";
                } else if (predictionScore >= 40) {
                    category = "Netral";
                    categoryColor = "text-yellow-600";
                    categoryIcon = "😐";
                } else {
                    category = "Kurang Disukai";
                    categoryColor = "text-red-600";
                    categoryIcon = "😕";
                }

                // Show result
                setTimeout(() => {
                    progressSection.classList.add('hidden');
                    resultSection.classList.remove('hidden');

                    resultText.innerHTML = `
                        <div class="text-center mb-4">
                            <div class="text-6xl mb-2">${categoryIcon}</div>
                            <h5 class="text-2xl font-bold ${categoryColor} mb-2">${category}</h5>
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-3xl font-bold text-gray-800">${predictionScore}</span>
                                <span class="text-lg text-gray-600">/ 100</span>
                            </div>
                        </div>
                    `;

                    // Display input summary
                    const inputSummary = document.getElementById('inputSummary');
                    inputSummary.innerHTML = `
                        <div class="flex items-center gap-2">
                            <span class="text-purple-600 font-semibold">💰 Harga:</span>
                            <span class="text-gray-700">${price} VP</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-blue-600 font-semibold">✨ Efek Visual:</span>
                            <span class="text-gray-700">${visualEffect}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-yellow-600 font-semibold">⭐ Rarity:</span>
                            <span class="text-gray-700">${rarity}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-pink-600 font-semibold">📊 Popularity:</span>
                            <span class="text-gray-700">${popularity}</span>
                        </div>
                    `;

                    // Smooth scroll to result
                    resultSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 500);
            }, 2500);
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

        // Save button handler
        if (saveBtn) {
            saveBtn.addEventListener('click', () => {
                const formData = new FormData(generateDataForm);
                const resultData = {
                    timestamp: new Date().toISOString(),
                    input: {
                        price: formData.get('price'),
                        visualEffect: formData.get('visualEffect'),
                        rarity: formData.get('rarity'),
                        popularity: formData.get('popularity')
                    },
                    prediction: {
                        score: document.querySelector('#resultText .text-3xl').textContent,
                        category: document.querySelector('#resultText .text-2xl').textContent
                    }
                };

                // Save to localStorage
                const savedResults = JSON.parse(localStorage.getItem('predictionHistory') || '[]');
                savedResults.push(resultData);
                localStorage.setItem('predictionHistory', JSON.stringify(savedResults));

                // Show success message
                alert('Hasil prediksi berhasil disimpan!');
            });
        }
    </script>
</body>

</html>
