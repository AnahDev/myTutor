<x-app-layout>
    {{-- Definimos el header de la página --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tutorias Agendadas') }}
        </h2>
    </x-slot>

    {{-- Contenido principal de la página --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Header con botón de crear cita --}}
                    <div class="flex justify-between items-center mb-6">
                        {{-- <h3 class="text-lg font-medium text-gray-900">Tu Agenda</h3> --}}
                        {{-- Solo mostrar el botón de crear si el usuario puede crear citas --}}
                        @can('create', App\Models\Cita::class)
                            <a href="{{ route('citas.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Agendar Nueva Cita
                            </a>
                        @endcan
                    </div>

                    {{-- Mensaje de éxito --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Contenido principal --}}
                    @if ($citas->isEmpty())
                        <div class="text-center py-8">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 0v10a1 1 0 001 1h4a1 1 0 001-1V7m-6 0H4a1 1 0 00-1 1v10a1 1 0 001 1h2m12-12V3a1 1 0 00-1-1h-2m0 0V3a1 1 0 00-1-1H9a1 1 0 00-1 1v4" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No tienes citas programadas.</p>
                            </div>
                        </div>
                    @else
                        {{-- Tabla de citas --}}
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Desde</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hasta</th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Materia
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            @if (auth()->user()->esEstudiante())
                                                Tutor
                                            @else
                                                Estudiante
                                            @endif
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nota
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($citas as $cita)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $cita->dia->format('d/m/Y') }}
                                                {{-- {{ $cita->horario->dia }} --}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $cita->hora_inicio->format('H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $cita->hora_fin->format('H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $cita->materia->nombre }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                @if (auth()->user()->esEstudiante())
                                                    {{ $cita->tutor->user->name }} {{ $cita->tutor->user->lastname }}
                                                @else
                                                    {{ $cita->estudiante->name }} {{ $cita->estudiante->lastname }}
                                                @endif

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $cita->nota }} </td>

                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex px-2 text-xs font-semibold rounded-full 
                                                    {{ $cita->estado === 'completado'
                                                        ? 'bg-green-100 text-green-800'
                                                        : ($cita->estado === 'cancelado'
                                                            ? 'bg-red-100 text-red-800'
                                                            : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ ucfirst($cita->estado) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    {{-- Botón para ver detalles --}}
                                                    {{-- @can('view', $cita)
                                                        <a href="{{ route('citas.show', $cita) }}"
                                                            class="text-blue-600 hover:text-blue-900">Ver</a>
                                                    @endcan --}}

                                                    {{-- Botón para editar (solo tutores)
                                                    @can('update', $cita)
                                                        <a href="{{ route('citas.edit', $cita) }}"
                                                            class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                                    @endcan --}}

                                                    {{-- Botón para cambiar estado (solo tutores) --}}
                                                    @can('updateStatus', $cita)
                                                        @if ($cita->estado !== 'completado' && $cita->estado !== 'cancelado')
                                                            <div class="relative inline-block text-left">
                                                                <button type="button"
                                                                    class="text-gray-600 hover:text-gray-900 focus:outline-none"
                                                                    onclick="toggleDropdown('dropdown-{{ $cita->id }}')">
                                                                    Estado
                                                                </button>
                                                                <div id="dropdown-{{ $cita->id }}"
                                                                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                                                    <div class="py-1">
                                                                        <form method="POST"
                                                                            action="{{ route('citas.update-status', $cita) }}">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            <button type="submit" name="estado"
                                                                                value="confirmado"
                                                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                                Confirmar
                                                                            </button>
                                                                            <button type="submit" name="estado"
                                                                                value="completado"
                                                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                                Completar
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endcan

                                                    {{-- @can('updateStatus', $cita)
                                                        @if ($cita->estado !== 'completado' && $cita->estado !== 'cancelado')
                                                            <div class="relative inline-block text-left">
                                                                <button type="button"
                                                                    class="text-gray-600 hover:text-gray-900 focus:outline-none"
                                                                    onclick="toggleDropdown('dropdown-{{ $cita->id }}')">
                                                                    Estado
                                                                </button>
                                                                <div id="dropdown-{{ $cita->id }}"
                                                                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                                                    <div class="py-1">
                                                                        <form method="POST"
                                                                            action="{{ route('citas.update-status', $cita) }}">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            @if ($cita->estado === 'pendiente')
                                                                                <button type="submit" name="estado"
                                                                                    value="confirmado"
                                                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                                    Confirmar
                                                                                </button>
                                                                            @elseif ($cita->estado === 'confirmado')
                                                                                <button type="submit" name="estado"
                                                                                    value="completado"
                                                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                                    Completar
                                                                                </button>
                                                                            @endif
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endcan --}}

                                                    {{-- Botón para cancelar --}}
                                                    @can('cancel', $cita)
                                                        @if ($cita->estado !== 'completado' && $cita->estado !== 'cancelado')
                                                            <form method="POST"
                                                                action="{{ route('citas.cancel', $cita) }}" class="inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                    class="text-red-600 hover:text-red-900"
                                                                    onclick="return confirm('¿Estás seguro de cancelar esta cita?')">
                                                                    Cancelar
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endcan

                                                    {{-- Botón para eliminar --}}
                                                    @can('delete', $cita)
                                                        <form method="POST" action="{{ route('citas.destroy', $cita) }}"
                                                            class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                                onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                                                                Eliminar
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
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript para el dropdown --}}
    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');

            // Cerrar otros dropdowns abiertos
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (el.id !== dropdownId) {
                    el.classList.add('hidden');
                }
            });
        }

        // Cerrar dropdown al hacer clic fuera
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.relative')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });
    </script>
</x-app-layout>
