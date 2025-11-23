<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
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
</head>
<body class="font-sans antialiased">
    <!-- Sidebar -->
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64">
                <!-- Sidebar component -->
                <div class="flex flex-col flex-grow bg-gradient-to-b from-indigo-700 to-purple-800 pt-5 pb-4 overflow-y-auto">
                    <!-- Logo -->
                    <div class="flex items-center flex-shrink-0 px-4">
                        <div class="flex items-center">
                            <div class="bg-white p-2 rounded-lg">
                                <span class="text-2xl">🎓</span>
                            </div>
                            <div class="ml-3">
                                <h1 class="text-white text-xl font-bold">PILKETOS</h1>
                                <p class="text-indigo-200 text-xs">Admin Panel</p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="mt-8 flex-1 flex flex-col space-y-2 px-4">
                        <a href="{{ route('admin.dashboard') }}"
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-indigo-600 shadow-lg' : 'text-indigo-100 hover:bg-indigo-600 hover:text-white' }}">
                            <span class="mr-3 text-lg">📊</span>
                            Dashboard
                        </a>

                        <a href="{{ route('admin.candidates') }}"
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.candidates*') ? 'bg-white text-indigo-600 shadow-lg' : 'text-indigo-100 hover:bg-indigo-600 hover:text-white' }}">
                            <span class="mr-3 text-lg">👥</span>
                            Kelola Kandidat
                        </a>

                        <a href="{{ route('admin.voting.results') }}"
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.voting.results') ? 'bg-white text-indigo-600 shadow-lg' : 'text-indigo-100 hover:bg-indigo-600 hover:text-white' }}">
                            <span class="mr-3 text-lg">📈</span>
                            Hasil Voting
                        </a>

                        <a href="{{ route('admin.users') }}"
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users') ? 'bg-white text-indigo-600 shadow-lg' : 'text-indigo-100 hover:bg-indigo-600 hover:text-white' }}">
                            <span class="mr-3 text-lg">👤</span>
                            Kelola User
                        </a>

                        <a href="{{ route('dashboard') }}"
                           class="group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-indigo-100 hover:bg-indigo-600 hover:text-white mt-8">
                            <span class="mr-3 text-lg">👤</span>
                            Kembali ke User
                        </a>
                    </nav>

                    <!-- User Info -->
                    <div class="flex-shrink-0 flex border-t border-indigo-600 p-4">
                        <div class="flex items-center w-full">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-indigo-700 font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="ml-3 min-w-0">
                                <p class="text-base font-medium text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-indigo-200 truncate">Administrator</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                                @csrf
                                <button type="submit" class="text-indigo-200 hover:text-white p-1 rounded">
                                    <span class="text-lg">🚪</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col min-w-0 flex-1 overflow-hidden">
            <!-- Mobile top bar -->
            <div class="lg:hidden">
                <div class="flex items-center justify-between bg-indigo-700 px-4 py-2 sm:px-6">
                    <div class="flex items-center">
                        <div class="bg-white p-1 rounded">
                            <span class="text-xl">🎓</span>
                        </div>
                        <h1 class="ml-2 text-white text-lg font-bold">PILKETOS</h1>
                    </div>
                    <button onclick="toggleMobileMenu()" class="text-white p-2">
                        <span class="text-xl">☰</span>
                    </button>
                </div>

                <!-- Mobile menu -->
                <div id="mobileMenu" class="hidden bg-indigo-600 px-4 py-2">
                    <div class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-white rounded-lg hover:bg-indigo-500">📊 Dashboard</a>
                        <a href="{{ route('admin.candidates') }}" class="block px-3 py-2 text-white rounded-lg hover:bg-indigo-500">👥 Kandidat</a>
                        <a href="{{ route('admin.voting.results') }}" class="block px-3 py-2 text-white rounded-lg hover:bg-indigo-500">📈 Hasil</a>
                        <a href="{{ route('admin.users') }}" class="block px-3 py-2 text-white rounded-lg hover:bg-indigo-500">👤 User</a>
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-white rounded-lg hover:bg-indigo-500 mt-4">👤 User View</a>
                    </div>
                </div>
            </div>

            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            @yield('header', 'Admin Dashboard')
                        </h1>
                        <p class="text-gray-500 text-sm mt-1">
                            {{ now()->translatedFormat('l, d F Y') }}
                        </p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="hidden sm:flex items-center space-x-2 bg-green-50 px-3 py-1 rounded-full border border-green-200">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-green-700 text-sm font-medium">Online</span>
                        </div>
                        <div class="text-right hidden sm:block">
                            <p class="text-sm text-gray-600">Welcome back,</p>
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 relative overflow-y-auto focus:outline-none bg-gray-50">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Notifications -->
                        @if(session('success'))
                            <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-center animate-fade-in">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-green-600 text-lg">✅</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-center animate-fade-in">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                        <span class="text-red-600 text-lg">❌</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Page Content -->
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Auto hide alerts
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
                alerts.forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</body>
</html>
