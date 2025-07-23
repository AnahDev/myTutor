<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Mis Materias') }}
            </h2>
            <div class="h-1 w-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"></div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
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

            <!-- Tarjeta principal -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                <div class="p-8">
                    <!-- Header con botón -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 space-y-4 sm:space-y-0">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Gestiona tus materias</h3>
                            <p class="text-sm text-gray-500">Administra las materias que enseñas como tutor</p>
                        </div>
                        <a href="{{ route('tutor.materias.create') }}"
                            class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 hover:from-blue-700 hover:to-purple-700">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Agregar Materia
                        </a>
                    </div>

                    <!-- Tabla mejorada -->
                    <div class="overflow-hidden rounded-xl border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <span>Materia</span>
                                        </div>
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span>Descripción</span>
                                        </div>
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                            <span>Acciones</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($materiasDelTutor as $materia)
                                    <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center text-white font-semibold text-sm mr-3">
                                                    {{ strtoupper(substr($materia->nombre, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900">
                                                        {{ $materia->nombre }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600 max-w-xs">
                                                {{ Str::limit($materia->descripcion, 60) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('tutor.materias.edit', $materia->id) }}"
                                                    class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-lg transition-colors duration-150 hover:scale-105 transform"
                                                    title="Editar">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('tutor.materias.destroy', $materia->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center justify-center w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors duration-150 hover:scale-105 transform"
                                                        title="Eliminar"
                                                        onclick="return confirm('¿Seguro que deseas eliminar esta materia?')">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                                <h3 class="text-lg font-medium text-gray-900 mb-1">No tienes materias
                                                    asignadas</h3>
                                                <p class="text-gray-500 mb-4">Comienza agregando tu primera materia
                                                    para enseñar</p>
                                                <a href="{{ route('tutor.materias.create') }}"
                                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    Agregar primera materia
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
