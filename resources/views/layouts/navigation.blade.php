<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-2 rounded-lg">
                            <span class="text-white text-xl font-bold">🎓</span>
                        </div>
                        <div class="ml-3">
                            <h1 class="text-xl font-bold text-gray-900">PILKETOS</h1>
                            <p class="text-xs text-gray-500">Pemilihan Ketua OSIS</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                @if(Auth::user()->email !== 'admin@pilketos.id')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('voting.candidates')" :active="request()->routeIs('voting.candidates')" class="flex items-center">
                        <span class="mr-2 text-lg">🗳️</span> Voting
                    </x-nav-link>
                    <x-nav-link :href="route('voting.results')" :active="request()->routeIs('voting.results')" class="flex items-center">
                        <span class="mr-2 text-lg">📊</span> Hasil
                    </x-nav-link>
                    <x-nav-link :href="route('voting.profile')" :active="request()->routeIs('voting.profile')" class="flex items-center">
                        <span class="mr-2 text-lg">👤</span> Profil Saya
                    </x-nav-link>
                    <x-nav-link :href="route('voting.instructions')" :active="request()->routeIs('voting.instructions')" class="flex items-center">
                        <span class="mr-2 text-lg">📚</span> Panduan
                    </x-nav-link>
                </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-2">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left">
                                    <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">
                                        @if(Auth::user()->email === 'admin@pilketos.id')
                                            Administrator
                                        @else
                                            {{ Auth::user()->kelas }}
                                        @endif
                                    </div>
                                </div>
                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->email === 'admin@pilketos.id')
                            <x-dropdown-link :href="route('admin.dashboard')" class="flex items-center">
                                <span class="mr-2">👑</span> Admin Panel
                            </x-dropdown-link>
                            <div class="border-t my-1"></div>
                        @endif

                        <x-dropdown-link :href="route('voting.profile')" class="flex items-center">
                            <span class="mr-2">👤</span> Profil Saya
                        </x-dropdown-link>

                        @if(Auth::user()->email !== 'admin@pilketos.id')
                        <x-dropdown-link :href="route('voting.instructions')" class="flex items-center">
                            <span class="mr-2">📚</span> Panduan
                        </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="flex items-center text-red-600">
                                <span class="mr-2">🚪</span> Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->email !== 'admin@pilketos.id')
            <x-responsive-nav-link :href="route('voting.candidates')" :active="request()->routeIs('voting.candidates')" class="flex items-center">
                <span class="mr-3 text-lg">🗳️</span> Voting
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('voting.results')" :active="request()->routeIs('voting.results')" class="flex items-center">
                <span class="mr-3 text-lg">📊</span> Hasil
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('voting.profile')" :active="request()->routeIs('voting.profile')" class="flex items-center">
                <span class="mr-3 text-lg">👤</span> Profil Saya
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('voting.instructions')" :active="request()->routeIs('voting.instructions')" class="flex items-center">
                <span class="mr-3 text-lg">📚</span> Panduan
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div>{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-500">
                            @if(Auth::user()->email === 'admin@pilketos.id')
                                Administrator
                            @else
                                {{ Auth::user()->kelas }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->email === 'admin@pilketos.id')
                    <x-responsive-nav-link :href="route('admin.dashboard')" class="flex items-center">
                        <span class="mr-3">👑</span> Admin Panel
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('voting.profile')" class="flex items-center">
                    <span class="mr-3">👤</span> Profil Saya
                </x-responsive-nav-link>

                @if(Auth::user()->email !== 'admin@pilketos.id')
                <x-responsive-nav-link :href="route('voting.instructions')" class="flex items-center">
                    <span class="mr-3">📚</span> Panduan
                </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center text-red-600">
                        <span class="mr-3">🚪</span> Logout
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
