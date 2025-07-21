<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Materias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <a href="{{ route('tutor.materias.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 transition">
                            &#43;Agregar Materia
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-200  ">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700  uppercase rounded-l-lg">
                                    Materia
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Descripción
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase rounded-r-lg">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($materiasDelTutor as $materia)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $materia->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $materia->descripcion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('tutor.materias.edit', $materia->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-emerald-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-500 focus:outline-none focus:border-emerald-700 focus:ring focus:ring-emerald-200 active:bg-emerald-600 transition"
                                            title="Editar">
                                            &#128394;</a>
                                        <form action="{{ route('tutor.materias.destroy', $materia->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-red-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 transition"
                                                title="Eliminar"
                                                onclick="return confirm('¿Seguro que deseas eliminar esta materia?')">
                                                &#10006;
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No tienes materias
                                        asignadas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
