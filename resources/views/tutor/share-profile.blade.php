<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Compartir Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Comparte tu perfil de tutor con este enlace o código QR.</p>

                    {{-- Enlace del Perfil --}}
                    <div class="mt-4">
                        <label for="profileLink" class="block text-sm font-medium text-gray-700">Enlace de tu
                            Perfil</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" id="profileLink"
                                class="flex-1 block w-full rounded-none rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                value="" readonly>
                            {{-- <button onclick="navigator.clipboard.writeText('{{ $qrCode }}')"
                                class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-3 text-gray-500 text-sm">
                                Copiar
                            </button> --}}
                        </div>
                    </div>

                    {{-- Código QR --}}
                    <div class="mt-8 text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Código QR</h3>
                        {{-- Genera el QR usando la fachada de SimpleSoftwareIO --}}
                        <div class="inline-block p-4 border border-gray-300 rounded-md">
                            {!! $qrCode !!}
                        </div>
                        <p class="mt-4 text-sm text-gray-500">Comparte este código para acceder a tu perfil.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
