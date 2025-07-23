<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Tutores Disponibles') }}
            </h2>
            <div class="h-1 w-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-full"></div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensajes de estado -->
            @if (session('success'))
                <div
                    class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tarjeta principal -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                <div class="p-8">
                    <!-- Header de la sección -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-1">Encuentra tu tutor ideal</h3>
                                <p class="text-sm text-gray-500">Explora los tutores disponibles y sus especialidades
                                </p>
                            </div>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>{{ $tutores->count() }} tutor(es) disponible(s)</span>
                            </div>
                        </div>

                        <!-- Línea divisoria decorativa -->
                        <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
                    </div>

                    <!-- Contenido principal -->
                    @if ($tutores->isEmpty())
                        <!-- Estado vacío -->
                        <div class="text-center py-16">
                            <div class="flex flex-col items-center">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mb-6">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay tutores disponibles</h3>
                                <p class="text-gray-500 max-w-md">
                                    Actualmente no hay tutores registrados en el sistema. Los tutores aparecerán aquí
                                    una vez que se registren.
                                </p>
                            </div>
                        </div>
                    @else
                        <!-- Tabla de tutores mejorada -->
                        <div class="overflow-hidden rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-50 to-green-50">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <span>Tutor</span>
                                            </div>
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-purple-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                                <span>Materias</span>
                                            </div>
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                <span>Contacto</span>
                                            </div>
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-orange-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span>Biografía</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach ($tutores as $tutor)
                                        <tr
                                            class="hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-purple-50/30 transition-all duration-200">
                                            <!-- Columna Tutor -->
                                            <td class="px-6 py-6">
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-lg mr-4 shadow-md">
                                                        {{ strtoupper(substr($tutor->user->name, 0, 1)) }}{{ strtoupper(substr($tutor->user->lastname, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-semibold text-gray-900">
                                                            {{ $tutor->user->name }} {{ $tutor->user->lastname }}
                                                        </div>
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            <span
                                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                <svg class="w-3 h-3 mr-1" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                Disponible
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Columna Materias -->
                                            <td class="px-6 py-6">
                                                <div class="space-y-1">
                                                    @forelse($tutor->materias as $materia)
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mr-1 mb-1">
                                                            <svg class="w-3 h-3 mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                            </svg>
                                                            {{ $materia->nombre }}
                                                        </span>
                                                    @empty
                                                        <span class="text-xs text-gray-400 italic">Sin materias
                                                            asignadas</span>
                                                    @endforelse
                                                </div>
                                            </td>

                                            <!-- Columna Contacto -->
                                            <td class="px-6 py-6">
                                                <div class="flex items-center space-x-2">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-green-600" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $tutor->telefono }}</div>
                                                        <div class="text-xs text-gray-500">Teléfono</div>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Columna Biografía -->
                                            <td class="px-6 py-6">
                                                <div class="max-w-xs">
                                                    @if ($tutor->bio)
                                                        <p class="text-sm text-gray-600 leading-relaxed">
                                                            {{ Str::limit($tutor->bio, 100) }}
                                                        </p>
                                                        @if (strlen($tutor->bio) > 100)
                                                            <button
                                                                class="text-xs text-blue-600 hover:text-blue-800 mt-1 font-medium"
                                                                onclick="toggleBio('bio-{{ $tutor->id }}')">
                                                                Ver más...
                                                            </button>
                                                            <div id="bio-{{ $tutor->id }}"
                                                                class="hidden mt-2 p-3 bg-gray-50 rounded-lg">
                                                                <p class="text-sm text-gray-700">{{ $tutor->bio }}
                                                                </p>
                                                                <button
                                                                    class="text-xs text-blue-600 hover:text-blue-800 mt-2 font-medium"
                                                                    onclick="toggleBio('bio-{{ $tutor->id }}')">
                                                                    Ver menos
                                                                </button>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <span class="text-sm text-gray-400 italic">Sin biografía</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Footer con información adicional -->
                        <div class="mt-6 flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    Tutores activos
                                </span>
                            </div>
                            <div>
                                Mostrando {{ $tutores->count() }} de {{ $tutores->count() }} tutor(es)
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para biografías expandibles -->
    <script>
        function toggleBio(bioId) {
            const bioElement = document.getElementById(bioId);
            if (bioElement) {
                bioElement.classList.toggle('hidden');
            }
        }
    </script>
</x-app-layout>
