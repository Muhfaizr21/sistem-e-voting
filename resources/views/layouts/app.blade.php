<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pilketos') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-8">
                <!-- Notifications -->
                @if(session('success'))
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center animate-fade-in shadow-sm">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <span class="text-green-600 text-lg">✅</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center animate-fade-in shadow-sm">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <span class="text-red-600 text-lg">❌</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-red-800 font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>

        <script>
            // Auto hide alerts after 5 seconds
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
        </style>
    </body>
</html>
