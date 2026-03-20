<nav
    class="fixed top-0 left-0 right-0 z-50 border-b border-gray-700 shadow-xl bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900">
    <div class="max-w-full px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo Section -->
            <div class="flex items-center space-x-3">
                <div
                    class="flex items-center justify-center w-10 h-10 rounded-lg shadow-lg bg-gradient-to-br from-red-600 to-red-700">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-lg font-bold tracking-wide text-white sm:text-xl">VALORANT PREDIKSI</span>
            </div>

            <!-- User Dropdown -->
            <div class="relative">
                <button id="userDropdownButton" type="button"
                    class="flex items-center px-3 py-2 space-x-2 text-sm text-white transition-colors duration-150 rounded-lg hover:bg-white hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50">
                    <i class="text-lg fas fa-user-circle"></i>
                    <span class="hidden font-medium sm:inline">{{ auth()->user()->name }}</span>
                    <i class="text-xs fas fa-chevron-down"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="userDropdownMenu"
                    class="absolute right-0 hidden w-48 mt-2 origin-top-right bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                    <div class="py-1">
                        <!-- User Info -->
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            <span
                                class="inline-block px-2 py-1 mt-2 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </div>

                        <!-- Profile Link -->
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="w-5 mr-3 text-gray-400 fas fa-user"></i>
                            Profile Saya
                        </a>

                        <!-- Divider -->
                        <div class="border-t border-gray-100"></div>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full px-4 py-2 text-sm text-left text-red-600 hover:bg-red-50">
                                <i class="w-5 mr-3 fas fa-sign-out-alt"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        // User Dropdown Toggle
        const userDropdownButton = document.getElementById('userDropdownButton');
        const userDropdownMenu = document.getElementById('userDropdownMenu');

        userDropdownButton.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdownButton.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });

        // Close dropdown when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                userDropdownMenu.classList.add('hidden');
            }
        });
    </script>
@endpush
