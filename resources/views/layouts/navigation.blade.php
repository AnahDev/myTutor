<nav x-data="{ open: false }"
    class="bg-gradient-to-r from-blue-50/80 via-indigo-50/80 to-purple-50/80 backdrop-blur-sm border-b border-white/20 shadow-sm z-70">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="cursor-pointer group">
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 to-blue-500/20 rounded-xl blur-sm group-hover:blur-md transition-all duration-300">
                            </div>
                            <img src="{{ asset('images/hero-img.jpg') }}"
                                class="relative h-10 w-auto border border-white/30 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105"
                                alt="MyTutor Logo">
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-8 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60 hover:shadow-md' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5a2 2 0 012-2h4a2 2 0 012 2v4H8V5z"></path>
                        </svg>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (Auth::user()->role === 'tutor' && !Auth::user()->tutor)
                        <x-nav-link :href="route('tutores.create')" :active="request()->routeIs('tutores.create')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('tutores.create') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60 hover:shadow-md' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ __('Agrega Tu Información') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role === 'tutor' && Auth::user()->tutor)
                        <x-nav-link :href="route('tutor.materias.index')" :active="request()->routeIs('tutor.materias.index')"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('tutor.materias.index') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60 hover:shadow-md' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            {{ __('Materias') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('tutores.index')" :active="request()->routeIs('tutores.index')"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('tutores.index') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60 hover:shadow-md' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        {{ __('Tutores') }}
                    </x-nav-link>

                    <x-nav-link :href="route('citas.index')" :active="request()->routeIs('citas.index')"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('citas.index') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60 hover:shadow-md' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ __('Mi Agenda') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 ">
                <x-dropdown align="right" width="48" class="z-70">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-4 py-2 border border-white/30 text-sm leading-4 font-medium rounded-xl text-gray-700 bg-white/60 backdrop-blur-sm hover:text-indigo-600 hover:bg-white/80 hover:shadow-lg focus:outline-none transition-all duration-300 group">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <span
                                        class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <div class="text-left">
                                    <div class="font-medium">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                                </div>
                            </div>
                            <div class="ml-3">
                                <svg class="fill-current h-4 w-4 transition-transform group-hover:rotate-180"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d=" M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1
                    1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-xl shadow-xl">
                            <x-dropdown-link :href="route('profile.edit')"
                                class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-all duration-200">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-indigo-600 hover:bg-white/60 focus:outline-none focus:bg-white/80 focus:text-indigo-600 transition-all duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white/80 backdrop-blur-sm border-t border-white/20">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="flex items-center w-full px-4 py-3 text-left text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if (Auth::user()->role === 'tutor' && !Auth::user()->tutor)
                <x-responsive-nav-link :href="route('tutores.create')" :active="request()->routeIs('tutores.create')"
                    class="flex items-center w-full px-4 py-3 text-left text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('tutores.create') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60' }}">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('Agrega Tu Información') }}
                </x-responsive-nav-link>
            @endif

            @if (Auth::user()->role === 'tutor' && Auth::user()->tutor)
                <x-responsive-nav-link :href="route('tutor.materias.index')" :active="request()->routeIs('tutor.materias.index')"
                    class="flex items-center w-full px-4 py-3 text-left text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('tutor.materias.index') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60' }}">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    {{ __('Materias') }}
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('tutores.index')" :active="request()->routeIs('tutores.index')"
                class="flex items-center w-full px-4 py-3 text-left text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('tutores.index') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                {{ __('Tutores') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('citas.index')" :active="request()->routeIs('citas.index')"
                class="flex items-center w-full px-4 py-3 text-left text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('citas.index') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60' }}">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                {{ __('Mi Agenda') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/20 bg-white/60">
            <div class="px-4">
                <div class="flex items-center mb-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-xl flex items-center justify-center mr-3">
                        <span class="text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                        <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="flex items-center w-full px-4 py-3 text-left text-sm font-medium rounded-xl text-gray-700 hover:text-indigo-600 hover:bg-white/60 transition-all duration-300">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center w-full px-4 py-3 text-left text-sm font-medium rounded-xl text-red-600 hover:text-red-700 hover:bg-red-50 transition-all duration-300">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
