<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Tus Estadisticas, {{ Auth::user()->name }}</h3>

                    {{-- <x-nav-link :href="route('tutor.profile.share')" :active="request()->routeIs('tutor.profile.share')"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('tutor.profile.share') ? 'bg-gradient-to-r from-indigo-500 to-blue-500 text-white shadow-lg' : 'text-gray-700 hover:text-indigo-600 hover:bg-white/60 hover:shadow-md' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ __('Mi QR') }}
                    </x-nav-link> --}}

                    {{-- Lógica condicional para mostrar el dashboard del tutor o del estudiante --}}
                    @if (Auth::user()->role === 'tutor')
                        {{-- Dashboard del Tutor --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            {{-- Tarjeta de Tutorías Completadas --}}
                            <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                                <h4 class="text-xl font-bold">Tutorías Completadas</h4>
                                <p class="text-3xl mt-2">125</p>
                            </div>

                            {{-- Tarjeta de Valoraciones --}}
                            <div class="bg-green-100 p-4 rounded-lg shadow-md">
                                <h4 class="text-xl font-bold">Valoraciones</h4>
                                <p class="text-3xl mt-2">89</p>
                            </div>

                            {{-- Tarjeta de Rating (Estrellas) --}}
                            <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                                <h4 class="text-xl font-bold">Rating</h4>
                                <div class="flex items-center mt-2">
                                    <span class="text-3xl">4.7</span>
                                    <span class="text-2xl ml-2">⭐</span>
                                </div>
                            </div>

                            {{-- Tarjeta de Posicionamiento --}}
                            <div class="bg-purple-100 p-4 rounded-lg shadow-md">
                                <h4 class="text-xl font-bold">Posicionamiento</h4>
                                <p class="text-3xl mt-2">#5</p>
                            </div>
                        </div>
                    @elseif (Auth::user()->role === 'estudiante')
                        {{-- Dashboard del Estudiante --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Tarjeta de Tutorías Completadas --}}
                            <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                                <h4 class="text-xl font-bold">Tutorías Completadas</h4>
                                <p class="text-3xl mt-2">8</p>
                            </div>

                            {{-- Tarjeta de Tutorías por Rating --}}
                            <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                                <h4 class="text-xl font-bold">Tutorías por Rating</h4>
                                <ul class="mt-2 text-lg">
                                    <li>⭐⭐⭐⭐⭐: 5</li>
                                    <li>⭐⭐⭐⭐: 2</li>
                                    <li>⭐⭐⭐: 1</li>
                                </ul>
                            </div>
                        </div>


                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <!-- Tarjeta del código QR -->
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                                    <div class="p-6 text-gray-900">
                                        <h3 class="text-lg font-semibold mb-4">Comparte tu perfil</h3>
                                        <div class="flex items-center space-x-6">
                                            <div class="flex-shrink-0">
                                                <!-- El código QR se carga dinámicamente -->
                                                <img src="{{ route('profile.qr') }}" alt="Código QR del perfil"
                                                    class="w-32 h-32 border border-gray-300 rounded-lg">
                                            </div>
                                            <div>
                                                <p class="text-gray-600 mb-2">
                                                    Escanea este código QR para compartir tu perfil de forma rápida
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    URL: {{ route('profile.public', auth()->user()) }}
                                                </p>
                                                <!-- Botón para copiar la URL -->
                                                <button onclick="copyToClipboard()"
                                                    class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                                    Copiar enlace
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Resto del contenido del dashboard -->
                            </div>
                        </div>
                    @else
                        {{-- Contenido por defecto (si el rol no está definido) --}}
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p>You're logged in!</p>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
