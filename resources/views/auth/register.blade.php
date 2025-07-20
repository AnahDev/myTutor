<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Lastname -->
        <div>
            <x-input-label for="lastname" :value="__('Apellido')" />
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
                required autofocus autocomplete="lastname" />
            <x-input-error :messages="$errors->get('lastname ')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Radio button para Estudiante -->
        <fieldset class="mt-4 flex justify-around">
            <legend class=" font-medium text-sm">Escoge un Rol</legend>
            <div class="flex items-center mt-2">
                <input id="role_estudiante" name="role" type="radio" value="estudiante"
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                    {{ old('role') == 'estudiante' ? 'checked' : '' }} required>
                <label for="role_estudiante" class="ml-2 block text-sm text-gray-900">
                    Estudiante
                </label>
            </div>
            <div class="flex items-center">
                <input id="role_tutor" name="role" type="radio" value="tutor"
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
                    {{ old('role') == 'tutor' ? 'checked' : '' }} required>
                <label for="role_tutor" class="ml-2 block text-sm text-gray-900">
                    Tutor
                </label>
            </div>
        </fieldset>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Ya estas registrado?') }}
            </a>

            <x-primary-button class="ms-4">

                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
