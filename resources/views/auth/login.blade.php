{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout> --}}
<x-guest-layout>

    <div class="max-w-md w-full relative z-10 ">

        <div>

            <!-- Efectos decorativos del card -->
            <div
                class="absolute -top-10 -left-10 w-40 h-40 bg-gradient-to-r from-indigo-500/20 to-blue-500/20 rounded-full blur-3xl">
            </div>
            <div
                class="absolute -bottom-10 -right-10 w-40 h-40 bg-gradient-to-r from-orange-400/20 to-pink-500/20 rounded-full blur-3xl">
            </div>

            <!-- Contenido del formulario -->
            <div class="relative z-10">
                <!-- Header con logo -->
                <div class="relative z-10 mb-8">
                    <div class="text-center">
                        <!-- Logo con efectos mejorados -->
                        <div class="relative inline-block group cursor-pointer">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 to-blue-500/20 rounded-3xl blur-xl group-hover:blur-2xl transition-all duration-500">
                            </div>
                            <div
                                class="relative w-24 h-24 bg-gradient-to-br from-indigo-500 via-blue-500 to-purple-500 rounded-3xl mx-auto flex items-center justify-center shadow-2xl group-hover:shadow-3xl group-hover:scale-105 transition-all duration-500">
                                <img src="{{ asset('images/hero-img.jpg') }}"
                                    class="w-16 h-16 rounded-2xl border-2 border-white/30 shadow-lg" alt="MyTutor Logo">
                            </div>
                        </div>

                        <!-- Brand name con efectos -->
                        <div class="mt-6">
                            <h1 class="text-4xl font-bold">
                                <span
                                    class="bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    MyTutor
                                </span>
                            </h1>
                            <p class="text-gray-600 mt-2 font-medium">Inicia Sesion para continuar tu Aprendizaje!</p>
                        </div>
                    </div>
                </div>


                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Correo')"
                            class="block text-sm font-semibold text-gray-700 mb-2" />
                        <div class="relative">
                            <x-text-input id="email"
                                class="w-full px-4 py-3 bg-white/60 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-gray-400"
                                type="email" name="email" :value="old('email')" required autofocus
                                autocomplete="username" placeholder="tu@email.com" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Contraseña')"
                            class="block text-sm font-semibold text-gray-700 mb-2" />
                        <div class="relative">
                            <x-text-input id="password"
                                class="w-full px-4 py-3 bg-white/60 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-gray-400"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="Tu contraseña" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="h-4 w-4 text-indigo-500 focus:ring-indigo-500 border-gray-300 rounded"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-700">{{ __('Recuerdame') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-indigo-500 hover:text-blue-500 transition-colors"
                                href="{{ route('password.request') }}">
                                {{ __('Olvidaste tu Contraseña?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <x-primary-button
                            class="w-full bg-gradient-to-r from-indigo-500 via-blue-500 to-pink-500 hover:from-indigo-600 hover:via-blue-600 hover:to-pink-600 text-white py-3 px-4 rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            {{ __('Entrar') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200/50"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white/80 text-gray-500">¿No tienes cuenta?</span>
                        </div>
                    </div>
                </div>

                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <a href="{{ route('register') }}"
                        class="w-full inline-flex justify-center py-3 px-4 border border-indigo-200 rounded-xl bg-white/60 backdrop-blur-sm text-sm font-medium text-indigo-600 hover:bg-indigo-50 hover:border-indigo-300 transition-all">
                        Crear nueva cuenta
                    </a>
                </div>
            </div>
        </div>

        {{-- <!-- Footer del formulario -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    ¿Necesitas ayuda?
                    <a href="#" class="font-medium text-indigo-500 hover:text-blue-500 transition-colors">
                        Contacta soporte
                    </a>
                </p>
            </div> --}}
    </div>
    {{-- </div> --}}
</x-guest-layout>
