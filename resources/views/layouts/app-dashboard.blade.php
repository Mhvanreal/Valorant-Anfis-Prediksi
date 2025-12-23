<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') -Valorant Predi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>

<body class="flex flex-col h-full bg-gray-50">
    <!-- Navbar -->
    @include('layouts.navbar-dashboard')

    <div class="flex flex-1 overflow-hidden pt-16">
        <!-- Sidebar -->
        @include('layouts.sidebar-dashboard')

        <!-- Main Content Wrapper -->
        <div class="flex flex-col flex-1 overflow-y-auto lg:ml-64">
            <!-- Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div class="mx-auto max-w-full">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @include('layouts.footer-dasboard')
        </div>
    </div>

    @stack('scripts')
</body>

</html>
