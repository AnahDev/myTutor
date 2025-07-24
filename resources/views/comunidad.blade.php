<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comunidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <p class="text-lg font-medium">
                        ¡Bienvenido a la comunidad! Próximamente, esta sección estará disponible con herramientas para
                        ayudarte a aprender y enseñar.
                    </p>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Card para Recursos --}}
                        <div
                            class="bg-gray-100 p-6 rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                            <div class="flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Recursos Educativos</h3>
                            <p class="text-gray-600">
                                Explora una biblioteca de videos y materiales didácticos sobre diversos temas. ¡Tu
                                conocimiento no tendrá límites!
                            </p>
                            <span
                                class="mt-4 inline-block text-sm font-medium text-white bg-indigo-500 rounded-full px-4 py-1">
                                Próximamente
                            </span>
                        </div>

                        {{-- Card para Foro --}}
                        <div
                            class="bg-gray-100 p-6 rounded-lg shadow-md transition duration-300 transform hover:scale-105">
                            <div class="flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">Foro de Preguntas y Respuestas</h3>
                            <p class="text-gray-600">
                                Conecta con otros estudiantes y tutores. Resuelve dudas, comparte conocimientos y
                                participa en discusiones enriquecedoras.
                            </p>
                            <span
                                class="mt-4 inline-block text-sm font-medium text-white bg-blue-500 rounded-full px-4 py-1">
                                Próximamente
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
