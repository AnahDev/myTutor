<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased h-full">
    <!-- Contenedor principal con gradiente mejorado -->
    <div
        class="min-h-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 relative overflow-hidden">

        <!-- Efectos decorativos de fondo mejorados -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Círculos decorativos con animación sutil -->
            <div
                class="absolute -top-40 -left-40 w-80 h-80 bg-gradient-to-r from-indigo-400/30 to-blue-400/30 rounded-full blur-3xl animate-pulse">
            </div>
            <div class="absolute top-1/3 -right-32 w-64 h-64 bg-gradient-to-r from-purple-400/25 to-pink-400/25 rounded-full blur-2xl animate-pulse"
                style="animation-delay: 1s;"></div>
            <div class="absolute -bottom-32 left-1/4 w-72 h-72 bg-gradient-to-r from-blue-400/20 to-indigo-400/20 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 2s;"></div>

            <!-- Elementos geométricos flotantes -->
            <div class="absolute top-1/4 left-10 w-4 h-4 bg-indigo-400/40 rounded-full animate-bounce"
                style="animation-delay: 0.5s;"></div>
            <div class="absolute top-3/4 right-20 w-3 h-3 bg-purple-400/40 rounded-full animate-bounce"
                style="animation-delay: 1.5s;"></div>
            <div class="absolute top-1/2 left-1/4 w-2 h-2 bg-blue-400/40 rounded-full animate-bounce"
                style="animation-delay: 0.8s;"></div>

            <!-- Líneas decorativas -->
            <div
                class="absolute top-0 left-1/3 w-px h-32 bg-gradient-to-b from-transparent via-indigo-300/30 to-transparent">
            </div>
            <div
                class="absolute bottom-0 right-1/3 w-px h-24 bg-gradient-to-t from-transparent via-purple-300/30 to-transparent">
            </div>
        </div>

        <!-- Logo/Brand section mejorado -->
        {{-- <div class="relative z-10 mb-8">
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
        </div> --}}

        <!-- Contenedor del formulario mejorado -->
        <div class="relative z-10 w-full sm:max-w-md">
            <!-- Efectos decorativos del card -->
            <div
                class="absolute -top-10 -left-10 w-40 h-40 bg-gradient-to-r from-indigo-500/20 to-blue-500/20 rounded-full blur-3xl">
            </div>
            <div
                class="absolute -bottom-10 -right-10 w-40 h-40 bg-gradient-to-r from-orange-400/20 to-pink-500/20 rounded-full blur-3xl">
            </div>

            <!-- Card principal con glassmorphism mejorado -->
            <div class="relative bg-white/70 backdrop-blur-xl shadow-2xl border border-white/30 rounded-3xl p-8 mx-6">
                <!-- Borde interior sutil -->
                <div
                    class="absolute inset-0 rounded-3xl bg-gradient-to-r from-indigo-500/5 via-transparent to-blue-500/5">
                </div>

                <!-- Contenido del slot -->
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Footer decorativo -->
        <div class="relative z-10 mt-8 text-center">
            {{-- <div class="flex items-center justify-center space-x-6 text-sm text-gray-500">
                <a href="#" class="hover:text-indigo-600 transition-colors duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Ayuda
                </a>
                <span class="text-gray-300">•</span>
                <a href="#" class="hover:text-indigo-600 transition-colors duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Términos
                </a>
                <span class="text-gray-300">•</span>
                <a href="#" class="hover:text-indigo-600 transition-colors duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    Privacidad
                </a>
            </div> --}}
            <p class="text-xs text-gray-400 mt-4">© 2024 MyTutor. Todos los derechos reservados.</p>
        </div>

        <!-- Gradient overlay en la parte inferior -->
        <div
            class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white/20 to-transparent pointer-events-none">
        </div>
    </div>

    <!-- Script para efectos interactivos -->
    <script>
        // Efecto parallax en elementos decorativos
        document.addEventListener('mousemove', (e) => {
            const mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
            const mouseY = (e.clientY / window.innerHeight - 0.5) * 2;

            // Mover elementos decorativos
            const decorativeElements = document.querySelectorAll('.absolute.w-4, .absolute.w-3, .absolute.w-2');
            decorativeElements.forEach((element, index) => {
                const speed = (index + 1) * 0.5;
                element.style.transform = `translate(${mouseX * speed}px, ${mouseY * speed}px)`;
            });
        });

        // Animación de entrada para el logo
        window.addEventListener('load', () => {
            const logo = document.querySelector('.group');
            if (logo) {
                logo.style.transform = 'scale(0) rotate(180deg)';
                logo.style.opacity = '0';
                setTimeout(() => {
                    logo.style.transition = 'all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1)';
                    logo.style.transform = 'scale(1) rotate(0deg)';
                    logo.style.opacity = '1';
                }, 100);
            }
        });
    </script>

    <!-- Estilos CSS adicionales -->
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(180deg);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Animación personalizada para el logo */
        @keyframes logoGlow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(99, 102, 241, 0.6);
            }
        }

        .group:hover .relative.w-24 {
            animation: logoGlow 2s ease-in-out infinite;
        }
    </style>
</body>

</html>
