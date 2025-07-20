<?php


namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorMateriaController extends Controller
{
    /**
     * Mostrar el formulario para gestionar las materias del tutor
     * Esta vista permitirá al tutor ver sus materias actuales y agregar nuevas
     */
    public function index()
    {
        // Obtener el tutor autenticado
        $tutor = Auth::user()->tutor;

        // Si el usuario no tiene perfil de tutor, redirigir
        if (!$tutor) {
            return redirect()->route('dashboard')->with('error', 'No tienes un perfil de tutor.');
        }

        // Obtener las materias que ya enseña el tutor
        $materiasDelTutor = $tutor->materias;

        // Obtener todas las materias disponibles para poder agregar nuevas
        $todasLasMaterias = Materia::all();

        // Obtener solo las materias que el tutor NO enseña aún
        $materiasDisponibles = $todasLasMaterias->diff($materiasDelTutor);

        return view('tutor.materias.index', compact('tutor', 'materiasDelTutor', 'materiasDisponibles', 'todasLasMaterias'));
    }

    public function create()
    {
        // Obtén las materias disponibles para agregar
        $tutor = Auth::user()->tutor;
        $materiasDelTutor = $tutor->materias;
        $materiasDisponibles = \App\Models\Materia::all()->diff($materiasDelTutor);

        return view('tutor.materias.create', compact('materiasDisponibles'));
    }

    /**
     * Agregar una materia al tutor
     * Utiliza el método attach() para crear la relación en la tabla pivote
     */
    public function store(Request $request)
    {
        // Validar que al menos uno de los campos esté presente
        $request->validate([
            'materia_id' => 'nullable|exists:materias,id',
            'nueva_materia' => 'nullable|string|max:100',

        ]);

        $tutor = Auth::user()->tutor;

        // Si el usuario seleccionó una materia existente
        if ($request->filled('materia_id')) {
            // Verificar que el tutor no tenga ya esta materia
            if ($tutor->materias->contains($request->materia_id)) {
                return redirect()->back()->with('error', 'Ya enseñas esta materia.');
            }
            // Relacionar la materia existente con el tutor
            $tutor->materias()->attach($request->materia_id);
        }
        // Si el usuario escribió una nueva materia
        elseif ($request->filled('nueva_materia')) {
            // Crear la nueva materia
            $materia = Materia::create([
                'nombre' => $request->nueva_materia,
                'descripcion' => $request->descripcion ?? '',
            ]);
            // Relacionar la nueva materia con el tutor
            $tutor->materias()->attach($materia->id);
        } else {
            // Si no seleccionó ni escribió nada, mostrar error
            return redirect()->back()->with('error', 'Debes seleccionar una materia o escribir una nueva.');
        }

        return redirect()->route('tutor.materias.index')->with('success', 'Materia agregada exitosamente.');
    }

    public function edit($materiaId)
    {
        $tutor = Auth::user()->tutor;
        $materia = $tutor->materias()->findOrFail($materiaId);
        return view('tutor.materias.edit', compact('materia'));
    }

    public function update(Request $request, $materiaId)
    {
        $tutor = Auth::user()->tutor;
        $materia = $tutor->materias()->findOrFail($materiaId);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $materia->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('tutor.materias.index')->with('success', 'Materia actualizada.');
    }
    /**
     * Eliminar una materia del tutor
     * Utiliza el método detach() para eliminar la relación de la tabla pivote
     */
    public function destroy($materiaId)
    {
        $tutor = Auth::user()->tutor;

        // Verificar que el tutor tenga esta materia
        if (!$tutor->materias->contains($materiaId)) {
            return redirect()->back()->with('error', 'No enseñas esta materia.');
        }

        // Eliminar la relación usando detach()
        // Esto elimina el registro de la tabla tutor_materia
        $tutor->materias()->detach($materiaId);

        return redirect()->route('tutor.materias.index')->with('success', 'Materia eliminada exitosamente.');
    }

    /**
     * Método alternativo para agregar múltiples materias de una vez
     * Útil si quieres permitir selección múltiple en el formulario
     */
    public function storeMultiple(Request $request)
    {
        $request->validate([
            'materias' => 'required|array',
            'materias.*' => 'exists:materias,id'
        ]);

        $tutor = Auth::user()->tutor;

        // sync() reemplaza todas las materias existentes con las nuevas
        // Si quieres agregar sin eliminar las existentes, usa attach()
        // $tutor->materias()->sync($request->materias);
        $tutor->materias()->attach($request->materias);

        return redirect()->route('tutor.materias.index')->with('success', 'Materias actualizadas exitosamente.');
    }
}
