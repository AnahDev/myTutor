<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider; // Para las redirecciones

class LoginController extends Controller
{
    // Constructor para aplicar el middleware 'guest'
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login'); // Necesitas crear esta vista
    }

    // Maneja el intento de login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Redirección basada en rol
            if (Auth::user()->role === 'tutor') {
                return redirect()->intended(RouteServiceProvider::TUTOR_DASHBOARD);
            } else {
                return redirect()->intended(RouteServiceProvider::STUDENT_DASHBOARD);
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Maneja el logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
