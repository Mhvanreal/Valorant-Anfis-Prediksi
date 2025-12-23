<aside class="hidden w-64 h-screen bg-white border-r border-gray-200 lg:block fixed left-0 top-16">
    <div class="flex flex-col h-full">
        <!-- Main Navigation -->
        <div class="flex-1 px-3 py-6 overflow-y-auto">
            <!-- Search Box -->
            <div class="px-2 mb-6">
                <div class="relative">
                    <input type="text" placeholder="Search menu..."
                        class="w-full py-2 pl-10 pr-4 text-sm text-gray-700 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <h3 class="px-4 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">Main Menu</h3>
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('dashboard') ? 'text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-md' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <a href="#"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50 group">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Predictions
                    <span
                        class="ml-auto px-2 py-0.5 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">3</span>
                </a>

                <a href="#"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50 group">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Analytics
                </a>
            </nav>

            <!-- Data Management Section -->
            <h3 class="px-4 mt-6 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">Management</h3>
            <nav class="space-y-1">
                <a href="#"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50 group">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    Weapons
                </a>

                <a href="#"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50 group">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                    </svg>
                    Skins
                </a>

                <a href="#"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50 group">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Users
                </a>
            </nav>

            <!-- Settings Section -->
            <h3 class="px-4 mt-6 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">Settings</h3>
            <nav class="space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('profile.edit') ? 'text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-md' : 'text-gray-700 hover:bg-gray-50' }} group">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-gray-400 group-hover:text-blue-600' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile
                </a>

                <a href="#"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50 group">
                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-blue-600" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </a>
            </nav>
        </div>

        <!-- User Info Footer -->
        <div class="p-4 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="ml-3 flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- Mobile Sidebar (Hidden on Desktop) -->
<div x-data="{ open: false }" class="lg:hidden">
    <!-- Mobile Sidebar Toggle Button -->
    <button @click="open = true"
        class="fixed bottom-4 right-4 z-50 flex items-center justify-center w-14 h-14 text-white bg-gradient-to-br from-blue-600 to-blue-700 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-110">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Mobile Sidebar Overlay -->
    <div x-show="open" @click="open = false" x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50"
        style="display: none;">
    </div>

    <!-- Mobile Sidebar -->
    <aside x-show="open" x-transition:enter="transition-transform ease-out duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-2xl"
        style="display: none;">
        <div class="flex flex-col h-full">
            <!-- Mobile Header -->
            <div
                class="flex items-center justify-between p-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="ml-2 text-lg font-bold text-gray-800">Menu</span>
                </div>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation - Same as Desktop -->
            <div class="flex-1 px-3 py-4 overflow-y-auto">
                <h3 class="px-4 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">Main Menu</h3>
                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}" @click="open = false"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('dashboard') ? 'text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-md' : 'text-gray-700 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="#" @click="open = false"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Predictions
                        <span
                            class="ml-auto px-2 py-0.5 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">3</span>
                    </a>

                    <a href="#" @click="open = false"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Analytics
                    </a>
                </nav>

                <h3 class="px-4 mt-6 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">Management</h3>
                <nav class="space-y-1">
                    <a href="#" @click="open = false"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        Weapons
                    </a>

                    <a href="#" @click="open = false"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        Skins
                    </a>

                    <a href="#" @click="open = false"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>
                </nav>

                <h3 class="px-4 mt-6 mb-3 text-xs font-semibold tracking-wider text-gray-400 uppercase">Settings</h3>
                <nav class="space-y-1">
                    <a href="{{ route('profile.edit') }}" @click="open = false"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile
                    </a>

                    <a href="#" @click="open = false"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg transition-all duration-150 hover:bg-gray-50 {{-- @if (auth()->user()->role === 'admin') --}}">
                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings {{-- @if (auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-home {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }}"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.data_pengguna.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.data_pengguna.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-users {{ request()->routeIs('admin.data_pengguna.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kelola Data Mahasiswa
                    </a>
                    <a href="{{ route('admin.data_dosen.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.data_dosen.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-chalkboard-teacher {{ request()->routeIs('admin.data_dosen.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kelola Data Dosen
                    </a> --}}

                        {{-- <a href="{{ route('admin.jadwal_lab') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.jadwal_lab*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-flask {{ request()->routeIs('admin.jadwal_lab*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kelola Jadwal Lab
                    </a>
                    <a href="{{ route('kalender.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kalender.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-calendar {{ request()->routeIs('kalender.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kalender Jadwal
                    </a> --}}
                        {{--
                    <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 transition-colors rounded-lg hover:bg-gray-100">
                        <i class="w-5 mr-3 text-gray-500 fas fa-tools"></i> Kelola Peralatan
                    </a> --}}
                        {{-- <a href="{{ route('admin.reports') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('admin.reports') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-chart-bar {{ request()->routeIs('admin.reports') ? 'text-white' : 'text-gray-500' }}"></i>
                        Laporan
                    </a> --}}
                        {{-- @elseif(auth()->user()->role === 'dosen')
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-home {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }}"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('dosens.jadwal_lab') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('dosens.jadwal_lab') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 text-gray-500 fas fa-calendar-alt {{ request()->routeIs('dosens.jadwal_lab') ? 'text-white' : 'text-gray-500' }}"></i>
                        Jadwal Laboroatorium
                    </a>
                    <a href="{{ route('kalender.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kalender.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-calendar {{ request()->routeIs('kalender.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kalender Jadwal
                    </a> --}}
                        {{-- <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 transition-colors rounded-lg hover:bg-gray-100">
                        <i class="w-5 mr-3 text-gray-500 fas fa-file-alt"></i> Laporan Praktikum
                    </a> --}}
                        {{-- @elseif(auth()->user()->role === 'mahasiswa')
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-home {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }}"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('mahasiswa.jadwal_lab') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('mahasiswa.jadwal_lab') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-calendar-alt {{ request()->routeIs('mahasiswa.jadwal_lab') ? 'text-white' : 'text-gray-500' }}"></i>
                        Jadwal laboratorium
                    </a>
                    <a href="{{ route('kalender.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kalender.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-calendar {{ request()->routeIs('kalender.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kalender Jadwal
                    </a> --}}
                        {{-- <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 transition-colors rounded-lg hover:bg-gray-100">
                        <i class="w-5 mr-3 text-gray-500 fas fa-flask"></i> Peminjaman Alat
                    </a> --}}

                </nav>
            </div>
        </div>
    </aside>

    <!-- Mobile Sidebar Toggle Button -->
    <div class="fixed z-50 bottom-4 right-4 lg:hidden">
        <button id="mobileSidebarToggle"
            class="flex items-center justify-center w-12 h-12 text-white transition-all bg-blue-600 rounded-full shadow-lg hover:bg-blue-700 hover:shadow-xl">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobileSidebarOverlay" class="fixed inset-0 z-40 hidden bg-gray-900 bg-opacity-50 lg:hidden"></div>

    <!-- Mobile Sidebar -->
    <aside id="mobileSidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 transition-transform duration-300 transform -translate-x-full bg-white shadow-xl lg:hidden">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center">
                    <i class="mr-3 text-2xl text-blue-600 fas fa-flask"></i>
                    <span class="text-lg font-bold text-gray-800">Menu</span>
                </div>
                <button id="closeMobileSidebar" class="text-gray-500 hover:text-gray-700">
                    <i class="text-xl fas fa-times"></i>
                </button>
            </div>
            <div class="flex-1 px-3 py-4 overflow-y-auto">
                <nav class="space-y-1">
                    {{-- @if (auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-home {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }}"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.data_pengguna.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.data_pengguna.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-users {{ request()->routeIs('admin.data_pengguna.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kelola Data Mahasiswa
                    </a>
                    <a href="{{ route('admin.data_dosen.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.data_dosen.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-chalkboard-teacher {{ request()->routeIs('admin.data_dosen.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kelola Data Dosen
                    </a>
                    <a href="{{ route('admin.jadwal_lab') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.jadwal_lab*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-flask {{ request()->routeIs('admin.jadwal_lab*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kelola Jadwal Lab
                    </a>
                    <a href="{{ route('kalender.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kalender.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-calendar {{ request()->routeIs('kalender.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kalender Jadwal
                    </a>
                    <a href="{{ route('admin.reports') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.reports') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-chart-bar {{ request()->routeIs('admin.reports') ? 'text-white' : 'text-gray-500' }}"></i>
                        Laporan
                    </a>
                @elseif(auth()->user()->role === 'dosen')
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-home {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }}"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('dosens.jadwal_lab') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('dosens.jadwal_lab') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 text-gray-500 fas fa-calendar-alt {{ request()->routeIs('dosens.jadwal_lab') ? 'text-white' : 'text-gray-500' }}"></i>
                        Jadwal Laboroatorium
                    </a>
                    <a href="{{ route('kalender.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kalender.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-calendar {{ request()->routeIs('kalender.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kalender Jadwal
                    </a> --}}
                    {{-- <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 transition-colors rounded-lg hover:bg-gray-100">
                        <i class="w-5 mr-3 text-gray-500 fas fa-file-alt"></i> Laporan Praktikum
                    </a> --}}
                    {{-- @elseif(auth()->user()->role === 'mahasiswa')
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-home {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-500' }}"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('mahasiswa.jadwal_lab') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('mahasiswa.jadwal_lab') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-calendar-alt {{ request()->routeIs('mahasiswa.jadwal_lab') ? 'text-white' : 'text-gray-500' }}"></i>
                        Jadwal laboratorium
                    </a>
                    <a href="{{ route('kalender.index') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kalender.*') ? 'text-white bg-blue-600 hover:bg-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i
                            class="w-5 mr-3 fas fa-calendar {{ request()->routeIs('kalender.*') ? 'text-white' : 'text-gray-500' }}"></i>
                        Kalender Jadwal
                    </a> --}}
                    {{-- <a href="#"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 transition-colors rounded-lg hover:bg-gray-100">
                        <i class="w-5 mr-3 text-gray-500 fas fa-flask"></i> Peminjaman Alat
                    </a> --}}
                    {{-- @endif --}}
                </nav>
            </div>
        </div>
    </aside>

    @push('scripts')
        {{-- <script>
        // Mobile Sidebar Toggle
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
        const closeMobileSidebar = document.getElementById('closeMobileSidebar');

        function openMobileSidebar() {
            mobileSidebar.classList.remove('-translate-x-full');
            mobileSidebarOverlay.classList.remove('hidden');
        }

        function closeMobileSidebarFunc() {
            mobileSidebar.classList.add('-translate-x-full');
            mobileSidebarOverlay.classList.add('hidden');
        }

        mobileSidebarToggle.addEventListener('click', openMobileSidebar);
        closeMobileSidebar.addEventListener('click', closeMobileSidebarFunc);
        mobileSidebarOverlay.addEventListener('click', closeMobileSidebarFunc);
    </script> --}}
    @endpush
