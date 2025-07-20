<x-app-layout>
    {{-- Definimos el header de la página --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Disponibles') }}
        </h2>
    </x-slot>

    {{-- Contenido principal de la página --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Header con botón de crear cita --}}

                    {{-- Mensaje de éxito --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    {{-- Mensaje de error --}}
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    {{-- Contenido principal --}}
                    @if ($tutores->isEmpty())
                        <div class="text-center py-8">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-6 0v10a1 1 0 001 1h4a1 1 0 001-1V7m-6 0H4a1 1 0 00-1 1v10a1 1 0 001 1h2m12-12V3a1 1 0 00-1-1h-2m0 0V3a1 1 0 00-1-1H9a1 1 0 00-1 1v4" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No hay Tutores disponibles.</p>
                            </div>
                        </div>
                    @else
                        {{-- Tabla de tutores --}}
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Materia</th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Telefono
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bio
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tutores as $tutor)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $tutor->user->name }} {{ $tutor->user->lastname }}
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($tutor->materias as $materia)
                                                        <li>{{ $materia->nombre }}</li>
                                                    @endforeach
                                                </ul>



                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                                                {{ $tutor->telefono }}

                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">

                                                {{ $tutor->bio }}

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
    {{-- <script>
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
    </script> --}}
</x-app-layout>
