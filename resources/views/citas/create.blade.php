{{-- resources/views/citas/create.blade.php - Vista para crear nueva cita --}}
{{-- <x-app-layout>
    {{-- Definimos el header de la página --}}
<x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agendar Nueva Cita') }}
        </h2>
        {{-- Botón para regresar a la lista de citas --}}
        <a href="{{ route('citas.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Volver a Mis Citas
        </a>
    </div>
</x-slot>

{{-- Contenido principal de la página --}}
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{-- Título de la sección --}}
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Información de la Cita</h3>
                    <p class="text-sm text-gray-600">
                        Completa los siguientes campos para agendar tu sesión de tutoría.
                    </p>
                </div>

                {{-- Mostrar errores de validación --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Hay algunos errores en el formulario:
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Formulario principal --}}
                <form method="POST" action="{{ route('citas.store') }}" class="space-y-6">
                    @csrf

                    {{-- Sección 1: Selección de materia --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="materia_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Materia *
                            </label>
                            @php
                                $selectClasses =
                                    'block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm';
                                $borderClass = $errors->has('materia_id') ? 'border-red-300' : 'border-gray-300';
                            @endphp
                            <select id="materia_id" name="materia_id" class="{{ $selectClasses }} {{ $borderClass }}"
                                onchange="loadTutores(this.value)" required>
                                <option value="">Selecciona una materia...</option>
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id }}"
                                        {{ old('materia_id') == $materia->id ? 'selected' : '' }}>
                                        {{ $materia->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            @error('materia_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                Los tutores disponibles se mostrarán según la materia seleccionada.
                            </p>
                        </div>

                        {{-- Sección 2: Selección de tutor --}}
                        <div>
                            <label for="tutor_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Tutor *
                            </label>
                            @php
                                $borderClass = $errors->has('tutor_id') ? 'border-red-300' : 'border-gray-300';
                            @endphp
                            <select id="tutor_id" name="tutor_id" class="{{ $selectClasses }} {{ $borderClass }}"
                                required disabled>
                                <option value="">Primero selecciona una materia...</option>
                                @foreach ($tutores as $tutor)
                                    <option value="{{ $tutor->id }}"
                                        {{ old('tutor_id') == $tutor->id ? 'selected' : '' }}>
                                        {{ $tutor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tutor_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                Selecciona el tutor con quien deseas agendar la cita.
                            </p>
                        </div>
                    </div>

                    {{-- Sección 3: Selección de fecha y hora --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="dia" class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha *
                            </label>
                            @php
                                $borderClass = $errors->has('dia') ? 'border-red-300' : 'border-gray-300';
                            @endphp
                            <input type="date" id="dia" name="dia" value="{{ old('dia') }}"
                                min="{{ date('Y-m-d') }}" class="{{ $selectClasses }} {{ $borderClass }}" required>
                            @error('dia')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">
                                Selecciona la fecha para tu sesión de tutoría.
                            </p>
                        </div>

                        <div>
                            <fieldset>
                                <legend class="block text-sm font-medium text-gray-700 mb-2">Horario *</legend>
                                <div class="space-y-3">
                                    <div>
                                        <label for="hora-inicio" class="block text-sm font-medium text-gray-600 mb-1">
                                            Hora de inicio:
                                        </label>
                                        @php
                                            $borderClass = $errors->has('hora-inicio')
                                                ? 'border-red-300'
                                                : 'border-gray-300';
                                        @endphp
                                        <input type="time" id="hora-inicio" name="hora_inicio"
                                            value="{{ old('hora_inicio') }}"
                                            class="{{ $selectClasses }} {{ $borderClass }}">
                                        @error('hora-inicio')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="hora-fin" class="block text-sm font-medium text-gray-600 mb-1">
                                            Hora de fin:
                                        </label>
                                        @php
                                            $borderClass = $errors->has('hora-fin')
                                                ? 'border-red-300'
                                                : 'border-gray-300';
                                        @endphp
                                        <input type="time" id="hora-fin" name="hora_fin"
                                            value="{{ old('hora_fin') }}"
                                            class="{{ $selectClasses }} {{ $borderClass }}">
                                        @error('hora-fin')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    {{-- Sección 4: Comentarios adicionales --}}
                    <div>
                        <label for="comentarios" class="block text-sm font-medium text-gray-700 mb-2">
                            Comentarios o notas (opcional)
                        </label>
                        @php
                            $borderClass = $errors->has('comentarios') ? 'border-red-300' : 'border-gray-300';
                        @endphp
                        <textarea id="comentarios" name="comentarios" maxlength="300" rows="3"
                            class="{{ $selectClasses }} {{ $borderClass }}"
                            placeholder="Describe los temas específicos que te gustaría revisar en la tutoría...">{{ old('comentarios') }}</textarea>
                        @error('comentarios')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            Ayuda a tu tutor a prepararse mejor para la sesión describiendo los temas que deseas
                            revisar.
                        </p>
                    </div>

                    {{-- Sección 5: Información adicional --}}
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">
                                    Información importante:
                                </h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Las citas deben ser agendadas con al menos 24 horas de anticipación</li>
                                        <li>Puedes cancelar o reprogramar tu cita hasta 2 horas antes</li>
                                        <li>Las sesiones de tutoría tienen una duración estándar de 60 minutos (1
                                            hora)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Botones de acción --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('citas.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 active:bg-gray-100 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Agendar Cita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript simplificado para funcionalidad dinámica --}}
<script>
    // JavaScript para cargar tutores según la materia seleccionada
    // Este script maneja únicamente la relación materia-tutor

    /**
     * Función principal para cargar tutores según la materia seleccionada
     * @param {string} materiaId - ID de la materia seleccionada
     */
    function loadTutores(materiaId) {
        const tutorSelect = document.getElementById('tutor_id');

        // Mostrar estado de carga y deshabilitar el select de tutores
        tutorSelect.innerHTML = '<option value="">Cargando tutores...</option>';
        tutorSelect.disabled = true;

        // Si no hay materia seleccionada, restaurar estado inicial
        if (!materiaId || materiaId === '') {
            tutorSelect.innerHTML = '<option value="">Primero selecciona una materia...</option>';
            tutorSelect.disabled = false;
            return;
        }

        // Realizar petición AJAX para obtener los tutores de la materia seleccionada
        fetch(`/api/materias/${materiaId}/tutores`)
            .then(response => {
                // Verificar que la respuesta del servidor sea exitosa
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Limpiar el select y agregar la opción por defecto
                tutorSelect.innerHTML = '<option value="">Selecciona un tutor...</option>';

                // Verificar si existen tutores disponibles para la materia
                if (!data || data.length === 0) {
                    tutorSelect.innerHTML =
                        '<option value="">No hay tutores disponibles para esta materia</option>';
                    tutorSelect.disabled = false;
                    return;
                }

                // Iterar sobre los tutores y crear las opciones del select
                data.forEach(tutor => {
                    const option = document.createElement('option');
                    option.value = tutor.id;

                    // Crear texto descriptivo que incluya el nombre del tutor
                    let textoTutor = tutor.name;

                    // Si el tutor tiene especialidad definida, agregarla al texto
                    if (tutor.especialidad && tutor.especialidad !== 'Sin especialidad definida') {
                        textoTutor += ` - ${tutor.especialidad}`;
                    }

                    option.textContent = textoTutor;

                    // Agregar atributos de datos para información adicional
                    option.setAttribute('data-email', tutor.email);
                    option.setAttribute('data-especialidad', tutor.especialidad);

                    tutorSelect.appendChild(option);
                });

                // Habilitar el select de tutores una vez cargados los datos
                tutorSelect.disabled = false;

                // Restaurar selección previa si existe (útil después de errores de validación)
                const tutorPrevio = tutorSelect.getAttribute('data-selected');
                if (tutorPrevio) {
                    tutorSelect.value = tutorPrevio;
                    tutorSelect.removeAttribute('data-selected');
                }
            })
            .catch(error => {
                // Manejo detallado de errores
                console.error('Error al cargar tutores:', error);

                let mensajeError = 'Error cargando tutores';

                // Personalizar el mensaje de error según el tipo de problema
                if (error.message.includes('404')) {
                    mensajeError = 'Materia no encontrada';
                } else if (error.message.includes('500')) {
                    mensajeError = 'Error del servidor - intenta más tarde';
                } else if (error.message.includes('NetworkError') || error.message.includes('fetch')) {
                    mensajeError = 'Error de conexión - verifica tu internet';
                }

                tutorSelect.innerHTML = `<option value="">${mensajeError}</option>`;
                tutorSelect.disabled = false;

                // Mostrar notificación al usuario
                mostrarNotificacion(mensajeError, 'error');
            });
    }

    /**
     * Función para mostrar notificaciones temporales al usuario
     * @param {string} mensaje - Mensaje a mostrar
     * @param {string} tipo - Tipo de notificación ('error', 'success', 'info')
     */
    function mostrarNotificacion(mensaje, tipo = 'info') {
        // Crear elemento de notificación con estilos apropiados
        const notificacion = document.createElement('div');
        notificacion.className = `fixed top-4 right-4 p-4 rounded-md shadow-lg z-50 ${
                tipo === 'error' ? 'bg-red-100 text-red-700 border border-red-300' :
                tipo === 'success' ? 'bg-green-100 text-green-700 border border-green-300' :
                'bg-blue-100 text-blue-700 border border-blue-300'
            }`;

        notificacion.innerHTML = `
                <div class="flex items-center">
                    <span class="mr-2">${mensaje}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-lg">&times;</button>
                </div>
            `;

        // Agregar la notificación al documento
        document.body.appendChild(notificacion);

        // Remover automáticamente la notificación después de 5 segundos
        setTimeout(() => {
            if (notificacion.parentElement) {
                notificacion.remove();
            }
        }, 5000);
    }

    // Inicialización cuando el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        const materiaSelect = document.getElementById('materia_id');
        const tutorSelect = document.getElementById('tutor_id');

        // Conservar valores seleccionados en caso de error de validación del formulario
        const materiaSeleccionada = materiaSelect.value;
        const tutorSeleccionado = tutorSelect.value;

        // Configurar atributo de datos para el tutor seleccionado previamente
        if (tutorSeleccionado) {
            tutorSelect.setAttribute('data-selected', tutorSeleccionado);
        }

        // Cargar tutores automáticamente si hay una materia ya seleccionada
        if (materiaSeleccionada) {
            loadTutores(materiaSeleccionada);
        }

        // Agregar event listener para cambios en la selección de materia
        materiaSelect.addEventListener('change', function() {
            loadTutores(this.value);
        });

        // Establecer fecha mínima como el día actual
        const fechaInput = document.getElementById('dia');
        const fechaHoy = new Date().toISOString().split('T')[0];
        fechaInput.setAttribute('min', fechaHoy);
    });
</script>
{{-- </x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Registrar Perfil de Tutor') }}
            </h2>
            <div class="h-1 w-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"></div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensajes de estado -->
            @if (session('error'))
                <div
                    class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tarjeta principal del formulario -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                <div class="p-8">
                    <!-- Header del formulario -->
                    <div class="mb-8 text-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Completa tu perfil de tutor</h3>
                        <p class="text-gray-500">Proporciona la información necesaria para que los estudiantes puedan
                            contactarte</p>
                    </div>

                    <!-- Formulario -->
                    <form action="{{ route('tutores.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Campo Teléfono -->
                        <div class="group">
                            <label for="telefono" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Teléfono
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="telefono" id="telefono" required maxlength="20"
                                    value="{{ old('telefono') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50/50 group-hover:bg-white"
                                    placeholder="Ej: +1 234 567 8900">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            @error('telefono')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Campo Biografía -->
                        <div class="group">
                            <label for="bio" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Biografía
                            </label>
                            <div class="relative">
                                <textarea name="bio" id="bio" maxlength="500" rows="4"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-100 transition-all duration-200 bg-gray-50/50 group-hover:bg-white resize-none"
                                    placeholder="Cuéntanos sobre tu experiencia como tutor, metodología de enseñanza, logros académicos...">{{ old('bio') }}</textarea>
                                <div class="absolute bottom-3 right-3 text-xs text-gray-400" id="bio-counter">
                                    <span id="bio-count">0</span>/500
                                </div>
                            </div>
                            @error('bio')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Campo QR Código -->
                        <div class="group">
                            <label for="qr_codigo" class="flex items-center text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                                QR Código
                                <span class="text-gray-400 text-xs ml-2">(opcional)</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="qr_codigo" id="qr_codigo" maxlength="255"
                                    value="{{ old('qr_codigo') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-200 bg-gray-50/50 group-hover:bg-white"
                                    placeholder="Código QR para contacto rápido">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                    </svg>
                                </div>
                            </div>
                            @error('qr_codigo')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Botón de envío -->
                        <div class="pt-6">
                            <button type="submit"
                                class="w-full group relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-blue-200">
                                <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Guardar Perfil de Tutor
                                <div
                                    class="absolute inset-0 rounded-xl bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-200">
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">
                    Al registrar tu perfil, los estudiantes podrán encontrarte y contactarte para sesiones de tutoría.
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript para contador de biografía -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bioTextarea = document.getElementById('bio');
            const bioCount = document.getElementById('bio-count');

            if (bioTextarea && bioCount) {
                // Actualizar contador inicial
                bioCount.textContent = bioTextarea.value.length;

                // Actualizar contador en tiempo real
                bioTextarea.addEventListener('input', function() {
                    const currentLength = this.value.length;
                    bioCount.textContent = currentLength;

                    // Cambiar color si se acerca al límite
                    const counter = document.getElementById('bio-counter');
                    if (currentLength > 450) {
                        counter.classList.add('text-red-500');
                        counter.classList.remove('text-gray-400');
                    } else if (currentLength > 400) {
                        counter.classList.add('text-yellow-500');
                        counter.classList.remove('text-gray-400', 'text-red-500');
                    } else {
                        counter.classList.add('text-gray-400');
                        counter.classList.remove('text-red-500', 'text-yellow-500');
                    }
                });
            }
        });
    </script>
</x-app-layout>
