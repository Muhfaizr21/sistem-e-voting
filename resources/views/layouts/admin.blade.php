<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin - {{ config('app.name', 'Pilketos') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .admin-sidebar {
                background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 100%);
            }
            .admin-nav-item {
                @apply flex items-center px-4 py-3 text-gray-300 hover:bg-blue-700 hover:text-white transition-colors duration-200 rounded-lg;
            }
            .admin-nav-item.active {
                @apply bg-blue-700 text-white;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="flex h-screen">
            <!-- Sidebar -->
            <div class="admin-sidebar w-64 flex-shrink-0 shadow-xl">
                <div class="p-6 border-b border-blue-700">
                    <h1 class="text-xl font-bold text-white flex items-center">
                        <span class="mr-2">🎓</span>
                        PILKETOS ADMIN
                    </h1>
                    <p class="text-blue-200 text-sm mt-1">Panel Administrator</p>
                </div>

                <nav class="mt-6 px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                       class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="mr-3">📊</span>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.candidates') }}"
                       class="admin-nav-item {{ request()->routeIs('admin.candidates*') ? 'active' : '' }}">
                        <span class="mr-3">👥</span>
                        Kelola Kandidat
                    </a>

                   <a href="{{ route('admin.voting.results') }}"
   class="admin-nav-item {{ request()->routeIs('admin.voting.results') ? 'active' : '' }}">
    <span class="mr-3">📊</span>
    Hasil Voting
</a>

                    <a href="{{ route('dashboard') }}"
                       class="admin-nav-item">
                        <span class="mr-3">👤</span>
                        Kembali ke User
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="pt-4">
                        @csrf
                        <button type="submit"
                                class="admin-nav-item w-full text-left text-red-300 hover:text-red-100 hover:bg-red-700">
                            <span class="mr-3">🚪</span>
                            Logout
                        </button>
                    </form>
                </nav>

                <!-- User Info -->
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-blue-700">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-white text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                            <p class="text-blue-200 text-xs">Administrator</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Top Header -->
                <header class="bg-white shadow-sm border-b">
                    <div class="flex items-center justify-between px-6 py-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">
                                @isset($header)
                                    {{ $header }}
                                @else
                                    Admin Dashboard
                                @endisset
                            </h2>
                            <p class="text-gray-600 text-sm mt-1">
                                {{ now()->translatedFormat('l, d F Y') }}
                            </p>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                🟢 Online
                            </div>
                            <div class="text-sm text-gray-500">
                                Welcome, <span class="font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                    <!-- Notifications -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                            <span class="text-lg mr-2">✅</span>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                            <span class="text-lg mr-2">❌</span>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- CONTENT SECTION - PERBAIKAN DI SINI -->
                    @yield('content')

                </main>
            </div>
        </div>

        <script>
            // Auto hide alerts after 5 seconds
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
                    alerts.forEach(alert => {
                        alert.style.transition = 'opacity 0.5s ease';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    });
                }, 5000);
            });
        </script>
    </body>
</html>
