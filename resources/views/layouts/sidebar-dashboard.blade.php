<aside
    class="hidden lg:block fixed top-16 left-0 w-64 h-[calc(100vh-4rem)]
           bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700
           z-40">

    <div class="flex flex-col h-full">

        <!-- MENU -->
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">

            <!-- MAIN -->
            <p class="px-2 mb-2 text-xs font-semibold text-gray-400 uppercase dark:text-gray-500">
                Main
            </p>

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400'
                    : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="text-xl material-icons">dashboard</span>
                Dashboard
            </a>

            <a href="#"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                       text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="text-xl material-icons">trending_up</span>
                Predictions
            </a>

            <!-- MANAGEMENT -->
            <p class="px-2 mt-6 mb-2 text-xs font-semibold text-gray-400 uppercase dark:text-gray-500">
                Management
            </p>

            <a href="{{ route('weapons.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                       text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="text-xl material-icons">sports_esports</span>
                Weapons
            </a>

            <a href="{{ route('skins.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                {{ request()->routeIs('skins.*')
                    ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400'
                    : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="text-xl material-icons">palette</span>
                Skins
            </a>

            <a href="#"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                       text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="text-xl material-icons">group</span>
                Users
            </a>

            <!-- SETTINGS -->
            <p class="px-2 mt-6 mb-2 text-xs font-semibold text-gray-400 uppercase dark:text-gray-500">
                Settings
            </p>

            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                {{ request()->routeIs('profile.edit')
                    ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400'
                    : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="text-xl material-icons">person</span>
                Profile
            </a>

        </nav>

        <!-- USER FOOTER -->
        <div class="px-4 py-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div
                    class="flex items-center justify-center w-10 h-10 font-bold text-white rounded-lg bg-gradient-to-br from-blue-600 to-blue-700">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate dark:text-white">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</aside>
