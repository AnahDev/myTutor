<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif

    {{-- <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tutor-purple': '#6366f1',
                        'tutor-blue': '#3b82f6',
                        'tutor-orange': '#f59e0b',
                        'tutor-pink': '#ec4899',
                        'tutor-coral': '#f97316'
                    }
                }
            }
        }
    </script> --}}
</head>
{{-- 
<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="bg-[#2DBAB1] flex items-center justify-end gap-4 p-2">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Entrar
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0 bg-slate-500">

    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body> --}}

<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">

    {{-- <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="bg-[#2DBAB1] flex items-center justify-end gap-4 p-2">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Entrar
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header> --}}
    <header class="w-full bg-white/80 backdrop-blur-md border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1
                        class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">
                        MyTutor
                    </h1>
                </div>

                <!-- Auth Links -->
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="inline-block px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors font-medium">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-700 hover:text-indigo-600 transition-colors font-medium">
                                Entrar
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-6 py-2 rounded-full hover:shadow-lg transform hover:scale-105 transition-all font-medium">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </header>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
    <!-- Navbar -->
    {{-- <nav class="bg-white/80 backdrop-blur-md border-b border-white/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1
                        class="text-2xl font-bold bg-gradient-to-r from-tutor-purple to-tutor-blue bg-clip-text text-transparent">
                        MyTutor
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-700 hover:text-tutor-purple transition-colors">
                        Entrar
                    </button>
                    <button
                        class="bg-gradient-to-r from-tutor-purple to-tutor-blue text-white px-6 py-2 rounded-full hover:shadow-lg transform hover:scale-105 transition-all">
                        Registrarse
                    </button>
                </div>
            </div>
        </div>
    </nav> --}}

    <!-- Hero Section -->
    <section class="relative py-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div class="space-y-4">
                        <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                            <span class="text-gray-900">Aprende con</span>
                            <span
                                class="bg-gradient-to-r from-tutor-purple via-tutor-pink to-tutor-orange bg-clip-text text-transparent block">
                                MyTutor
                            </span>
                        </h1>
                        <p class="text-xl text-gray-600 leading-relaxed">
                            Descubre una nueva forma de aprender. Conecta con tutores expertos y alcanza tus objetivos
                            académicos con nuestra plataforma innovadora.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button
                            class="bg-gradient-to-r from-tutor-purple to-tutor-blue text-white px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transform hover:scale-105 transition-all">
                            Comenzar Ahora
                        </button>
                        <button
                            class="border-2 border-tutor-purple text-tutor-purple px-8 py-4 rounded-full text-lg font-semibold hover:bg-tutor-purple hover:text-white transition-all">
                            Ver Demo
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 pt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-tutor-purple">500+</div>
                            <div class="text-gray-600">Tutores</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-tutor-orange">10K+</div>
                            <div class="text-gray-600">Estudiantes</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-tutor-pink">95%</div>
                            <div class="text-gray-600">Satisfacción</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Image -->
                <div class="relative">
                    <div class="relative z-10">
                        <!-- Aquí iría tu imagen de educación -->
                        <div
                            class="bg-gradient-to-br from-tutor-purple/20 to-tutor-orange/20 rounded-3xl p-8 backdrop-blur-sm border border-white/30">
                            <div
                                class="w-full h-96 bg-gradient-to-br from-tutor-blue/30 via-tutor-purple/30 to-tutor-pink/30 rounded-2xl flex items-center justify-center">
                                <!-- Placeholder para tu imagen -->
                                <div class="text-center">
                                    {{-- <div
                                        class="w-24 h-24 bg-gradient-to-br from-tutor-orange to-tutor-pink rounded-full mx-auto mb-4 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                    </div> --}}
                                    <img src="{{ asset('images/hero-img.jpg') }}" alt="Educación con MyTutor"
                                        class="w-full h-full object-contain rounded-xl">

                                    {{-- <p class="text-gray-700 font-medium">Tu imagen educativa aquí</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative elements -->
                    <div
                        class="absolute -top-4 -left-4 w-72 h-72 bg-gradient-to-r from-tutor-purple/20 to-tutor-blue/20 rounded-full blur-3xl">
                    </div>
                    <div
                        class="absolute -bottom-8 -right-8 w-96 h-96 bg-gradient-to-r from-tutor-orange/20 to-tutor-pink/20 rounded-full blur-3xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">¿Por qué elegir MyTutor?</h2>
                <p class="text-xl text-gray-600">Características que nos hacen únicos</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-white/30 hover:shadow-xl transition-all hover:transform hover:scale-105">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-tutor-purple to-tutor-blue rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tutores Expertos</h3>
                    <p class="text-gray-600">Conecta con profesionales calificados en tu área de estudio.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-white/30 hover:shadow-xl transition-all hover:transform hover:scale-105">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-tutor-orange to-tutor-coral rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Horarios Flexibles</h3>
                    <p class="text-gray-600">Aprende a tu ritmo con sesiones adaptadas a tu horario.</p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 border border-white/30 hover:shadow-xl transition-all hover:transform hover:scale-105">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-tutor-pink to-tutor-purple rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Seguimiento Personalizado</h3>
                    <p class="text-gray-600">Monitorea tu progreso con reportes detallados y personalizados.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-8">
                ¿Listo para comenzar tu
                <span class="bg-gradient-to-r from-tutor-purple to-tutor-orange bg-clip-text text-transparent">
                    aventura de aprendizaje?
                </span>
            </h2>
            <p class="text-xl text-gray-600 mb-12">Únete a miles de estudiantes que ya están mejorando sus habilidades
                con MyTutor</p>
            <button
                class="bg-gradient-to-r from-tutor-purple via-tutor-pink to-tutor-orange text-white px-12 py-4 rounded-full text-xl font-bold hover:shadow-2xl transform hover:scale-105 transition-all">
                Empezar Gratis
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto text-center">
            <h3
                class="text-2xl font-bold bg-gradient-to-r from-tutor-purple to-tutor-orange bg-clip-text text-transparent mb-4">
                MyTutor
            </h3>
            <p class="text-gray-400 mb-8">Tu plataforma de agendas personalizado</p>
            <div class="border-t border-gray-800 pt-8">
                <p class="text-gray-500">&copy; 2025 MyTutor. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>


</html>
