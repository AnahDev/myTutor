<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Muestra una lista de todas las materias.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $materias = Materia::orderBy('nombre')->get();
        // Debes crear una vista en: resources/views/materias/index.blade.php
        return view('materias.index', compact('materias'));
    }

    /**
     * Muestra el formulario para crear una nueva materia.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Debes crear una vista en: resources/views/materias/create.blade.php
        return view('materias.create');
    }

    /**
     * Almacena una nueva materia en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => $request->nueva_materia,
            // 'required|string|max:255|unique:materias,nombre',
            'descripcion' => 'nullable|string',
        ]);

        Materia::create($request->all());

        return redirect()->route('materias.index')
            ->with('success', 'Materia creada exitosamente.');
    }

    /**
     * Muestra los detalles de una materia específica.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\View\View
     */
    public function show(Materia $materia)
    {
        // Opcional: Carga los tutores que enseñan esta materia
        $materia->load('tutores.user');
        // Debes crear una vista en: resources/views/materias/show.blade.php
        return view('materias.show', compact('materia'));
    }

    /**
     * Muestra el formulario para editar una materia.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\View\View
     */
    public function edit(Materia $materia)
    {
        // Debes crear una vista en: resources/views/materias/edit.blade.php
        return view('materias.edit', compact('materia'));
    }

    /**
     * Actualiza la materia especificada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:materias,nombre,' . $materia->id,
            'descripcion' => 'nullable|string',
        ]);

        $materia->update($request->all());

        return redirect()->route('materias.index')
            ->with('success', 'Materia actualizada exitosamente.');
    }

    /**
     * Elimina la materia especificada de la base de datos.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Materia $materia)
    {
        // Aquí podrías añadir lógica para verificar si la materia tiene tutores o citas
        // antes de permitir su eliminación.
        $materia->delete();

        return redirect()->route('materias.index')
            ->with('success', 'Materia eliminada exitosamente.');
    }
}
