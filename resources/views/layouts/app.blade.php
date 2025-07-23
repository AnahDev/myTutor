<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

<body class="font-sans antialiased">
    <!-- Fondo con gradiente y efectos decorativos -->
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 relative overflow-hidden">
        <!-- Efectos decorativos de fondo -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -left-40 w-80 h-80 bg-gradient-to-r from-indigo-400/20 to-blue-400/20 rounded-full blur-3xl">
            </div>
            <div
                class="absolute top-1/2 -right-40 w-80 h-80 bg-gradient-to-r from-purple-400/20 to-pink-400/20 rounded-full blur-3xl">
            </div>
            <div
                class="absolute -bottom-40 left-1/2 w-80 h-80 bg-gradient-to-r from-blue-400/20 to-indigo-400/20 rounded-full blur-3xl">
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="relative z-10">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/60  shadow-sm border-b border-white/20">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center">
                            <div class="w-1 h-8 bg-gradient-to-b from-indigo-500 to-blue-500 rounded-full mr-4"></div>
                            <div
                                class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                {{ $header }}
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="relative">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 ">
                    <!-- Contenedor con fondo sutil para el contenido -->
                    <div
                        class="bg-white/40 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20 p-6 min-h-[calc(100vh-200px)]">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>

        <!-- Elementos decorativos adicionales -->
        <div
            class="fixed bottom-0 left-0 w-full h-32 bg-gradient-to-t from-white/10 to-transparent pointer-events-none">
        </div>
    </div>

    <!-- Scripts adicionales para efectos -->
    <script>
        // Efecto parallax sutil en los elementos decorativos
        document.addEventListener('mousemove', (e) => {
            const decorativeElements = document.querySelectorAll('.absolute');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            decorativeElements.forEach((element, index) => {
                if (element.classList.contains('blur-3xl')) {
                    const speed = (index + 1) * 0.5;
                    const x = (mouseX - 0.5) * speed;
                    const y = (mouseY - 0.5) * speed;
                    element.style.transform = `translate(${x}px, ${y}px)`;
                }
            });
        });
    </script>
</body>

</html>
