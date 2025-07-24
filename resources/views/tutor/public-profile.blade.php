<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Perfil de {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center space-x-6">
                        <!-- Avatar del usuario (si tienes uno) -->
                        <div class="flex-shrink-0">
                            <div class="h-20 w-20 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-xl font-bold text-gray-600">
                                    {{ substr($user->name, 0, 1) }}
                                </span>
                            </div>
                        </div>

                        <!-- Información del perfil -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                                Miembro desde {{ $user->created_at->format('F Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Aquí puedes agregar más información del perfil -->
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold text-gray-900">Acerca de</h4>
                        <p class="text-gray-700 mt-2">
                            <!-- Aquí mostrarías información adicional del usuario -->
                            Perfil público de {{ $user->name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
