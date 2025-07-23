<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Tutorías Agendadas') }}
            </h2>
            <div class="h-1 w-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"></div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div
                    class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
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
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Gestiona tus citas</h3>
                            <p class="text-sm text-gray-500">Administra y da seguimiento a tus tutorías</p>
                        </div>
                        @can('create', App\Models\Cita::class)
                            <a href="{{ route('citas.create') }}"
                                class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 hover:from-blue-700 hover:to-purple-700">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Agendar Nueva Cita
                            </a>
                        @endcan
                    </div>

                    @if ($citas->isEmpty())
                        <!-- Estado vacío -->
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 0v10a1 1 0 001 1h4a1 1 0 001-1V7m-6 0H4a1 1 0 00-1 1v10a1 1 0 001 1h2m12-12V3a1 1 0 00-1-1h-2" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">No tienes citas programadas</h3>
                            <p class="text-gray-500 mb-4">Agenda tu primera tutoría para comenzar</p>
                            @can('create', App\Models\Cita::class)
                                <a href="{{ route('citas.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Agendar primera cita
                                </a>
                            @endcan
                        </div>
                    @else
                        <!-- Tabla de citas - Removemos overflow-hidden del contenedor principal -->
                        <div class="rounded-xl border border-gray-200">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                                        <tr>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Fecha</th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Horario</th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Materia</th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                @if (auth()->user()->esEstudiante())
                                                    Tutor
                                                @else
                                                    Estudiante
                                                @endif
                                            </th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Estado</th>
                                            <th
                                                class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                                Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100">
                                        @foreach ($citas as $cita)
                                            <tr class="hover:bg-gray-50/50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-semibold text-gray-900">
                                                        {{ $cita->dia->format('d/m/Y') }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $cita->hora_inicio->format('H:i') }} -
                                                        {{ $cita->hora_fin->format('H:i') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center text-white font-semibold text-xs mr-3">
                                                            {{ strtoupper(substr($cita->materia->nombre, 0, 2)) }}
                                                        </div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $cita->materia->nombre }}</div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        @if (auth()->user()->esEstudiante())
                                                            {{ $cita->tutor->user->name }}
                                                            {{ $cita->tutor->user->lastname }}
                                                        @else
                                                            {{ $cita->estudiante->name }}
                                                            {{ $cita->estudiante->lastname }}
                                                        @endif
                                                    </div>
                                                    @if ($cita->nota)
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            {{ Str::limit($cita->nota, 30) }}</div>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                                        {{ $cita->estado === 'completado'
                                                            ? 'bg-green-100 text-green-800'
                                                            : ($cita->estado === 'cancelado'
                                                                ? 'bg-red-100 text-red-800'
                                                                : ($cita->estado === 'confirmado'
                                                                    ? 'bg-blue-100 text-blue-800'
                                                                    : 'bg-yellow-100 text-yellow-800')) }}">
                                                        {{ ucfirst($cita->estado) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap relative">
                                                    <div class="flex items-center space-x-2">
                                                        <!-- Botón cambiar estado - Solo para tutores -->
                                                        @can('updateStatus', $cita)
                                                            @if ($cita->estado !== 'completado' && $cita->estado !== 'cancelado')
                                                                <div class="relative inline-block text-left">
                                                                    <button type="button"
                                                                        class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg transition-colors duration-150 hover:scale-105 transform"
                                                                        onclick="toggleDropdown('dropdown-{{ $cita->id }}')"
                                                                        title="Cambiar estado">
                                                                        <svg class="w-4 h-4" fill="none"
                                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                                        </svg>
                                                                    </button>
                                                                    <!-- Dropdown con posición absoluta mejorada -->
                                                                    <div id="dropdown-{{ $cita->id }}"
                                                                        class="hidden absolute right-0 top-full mt-1 w-40 bg-white rounded-lg shadow-lg z-50 border">
                                                                        <div class="py-1">
                                                                            <form method="POST"
                                                                                action="{{ route('citas.update-status', $cita) }}">
                                                                                @csrf @method('PATCH')
                                                                                @if ($cita->estado === 'pendiente')
                                                                                    <button type="submit" name="estado"
                                                                                        value="confirmado"
                                                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors duration-150">
                                                                                        <div class="flex items-center">
                                                                                            <svg class="w-4 h-4 mr-2"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                viewBox="0 0 24 24">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    stroke-width="2"
                                                                                                    d="M5 13l4 4L19 7">
                                                                                                </path>
                                                                                            </svg>
                                                                                            Confirmar
                                                                                        </div>
                                                                                    </button>
                                                                                @endif
                                                                                @if (in_array($cita->estado, ['pendiente', 'confirmado']))
                                                                                    <button type="submit" name="estado"
                                                                                        value="completado"
                                                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors duration-150">
                                                                                        <div class="flex items-center">
                                                                                            <svg class="w-4 h-4 mr-2"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                viewBox="0 0 24 24">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    stroke-width="2"
                                                                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                                                </path>
                                                                                            </svg>
                                                                                            Completar
                                                                                        </div>
                                                                                    </button>
                                                                                @endif
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endcan

                                                        <!-- Botón cancelar -->
                                                        @can('cancel', $cita)
                                                            @if ($cita->estado !== 'completado' && $cita->estado !== 'cancelado')
                                                                <form method="POST"
                                                                    action="{{ route('citas.cancel', $cita) }}"
                                                                    class="inline">
                                                                    @csrf @method('PATCH')
                                                                    <button type="submit"
                                                                        class="inline-flex items-center justify-center w-8 h-8 bg-orange-100 hover:bg-orange-200 text-orange-600 rounded-lg transition-colors duration-150 hover:scale-105 transform"
                                                                        title="Cancelar"
                                                                        onclick="return confirm('¿Estás seguro de cancelar esta cita?')">
                                                                        <svg class="w-4 h-4" fill="none"
                                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M6 18L18 6M6 6l12 12" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @endcan

                                                        <!-- Botón eliminar -->
                                                        @can('delete', $cita)
                                                            <form method="POST"
                                                                action="{{ route('citas.destroy', $cita) }}"
                                                                class="inline">
                                                                @csrf @method('DELETE')
                                                                <button type="submit"
                                                                    class="inline-flex items-center justify-center w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-lg transition-colors duration-150 hover:scale-105 transform"
                                                                    title="Eliminar"
                                                                    onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                                                                    <svg class="w-4 h-4" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript mejorado para dropdown -->
    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const isHidden = dropdown.classList.contains('hidden');

            // Cerrar todos los dropdowns primero
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                el.classList.add('hidden');
            });

            // Si estaba cerrado, abrirlo
            if (isHidden) {
                dropdown.classList.remove('hidden');

                // Ajustar posición si se sale de la pantalla
                const rect = dropdown.getBoundingClientRect();
                const windowHeight = window.innerHeight;
                const windowWidth = window.innerWidth;

                // Si se sale por la derecha, alinearlo a la izquierda
                if (rect.right > windowWidth) {
                    dropdown.style.right = 'auto';
                    dropdown.style.left = '0';
                }

                // Si se sale por abajo, mostrarlo arriba
                if (rect.bottom > windowHeight) {
                    dropdown.style.top = 'auto';
                    dropdown.style.bottom = '100%';
                    dropdown.style.marginBottom = '4px';
                    dropdown.style.marginTop = '0';
                }
            }
        }

        // Cerrar dropdown al hacer clic fuera
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.relative')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                    // Resetear estilos de posicionamiento
                    el.style.right = '';
                    el.style.left = '';
                    el.style.top = '';
                    el.style.bottom = '';
                    el.style.marginBottom = '';
                    el.style.marginTop = '';
                });
            }
        });

        // Cerrar dropdown al presionar Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });
    </script>
</x-app-layout>
