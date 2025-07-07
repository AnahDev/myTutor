<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User; // Importa el modelo User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Constructor para aplicar el middleware 'guest'
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Muestra el formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register'); // Necesitas crear esta vista
    }

    // Maneja el intento de registro
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:tutor,student'], // Asegura que el rol sea 'tutor' o 'student'
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Asigna el rol
        ]);

        Auth::login($user); // Loguea al usuario automáticamente después del registro

        // Redirección basada en rol
        if (Auth::user()->role === 'tutor') {
            return redirect()->intended(RouteServiceProvider::TUTOR_DASHBOARD);
        } else {
            return redirect()->intended(RouteServiceProvider::STUDENT_DASHBOARD);
        }
    }
}
