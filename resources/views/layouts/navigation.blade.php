<!-- resources/views/components/navigation.blade.php -->
<nav class="fixed w-full top-0 z-50 nav-blur border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-12 h-12 modern-gradient rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-vote-yea text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">VoteAcademy</h1>
                        <p class="text-xs text-purple-600 font-semibold">Modern Voting System</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Beranda</a>
                <a href="#features" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Fitur</a>
                <a href="{{ route('voting.results') }}" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Hasil</a>

                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Admin</a>
                    @else
                        <a href="{{ route('voting.candidates') }}" class="text-gray-700 hover:text-purple-600 font-semibold transition-colors">Voting</a>
                    @endif
                @endauth
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-purple-600 font-semibold transition-colors">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Admin
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                </a>
                                <a href="{{ route('voting.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-user mr-2"></i>Profil Saya
                                </a>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                <i class="fas fa-cog mr-2"></i>Pengaturan
                            </a>
                            <hr class="my-1">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest Menu -->
                    <a href="{{ route('login') }}" class="hidden md:block text-gray-700 hover:text-purple-600 font-semibold transition-colors px-4 py-2">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary">
                        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
