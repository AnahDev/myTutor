<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;


class QrController extends Controller
{
    public function show(User $user)
    {
        return view('tutor.public-profile', compact('user'));
    }


    public function  generateQr(Request $request)
    {
        // $qrCode = QrCode::size(250)
        //     ->color(92, 173, 226)
        //     ->generate('EDUTeam, Tu plataforma de tutorias en linea');
        // // para devolver respuesta
        // // return response($qrCode)->header('Content-Type', 'image/svg+xml');

        // return view('tutor.share-profile', compact('qrCode'));

        $user = $request->user();

        if (!$user) {
            abort(403, 'Acceso no autorizado: Usuario no autenticado.');
        }

        // Construimos la URL completa del perfil público, pasando el ID explícitamente
        $profileUrl = route('tutor.public_profile', ['user' => $user->id]);

        // **MODIFICACIÓN CLAVE AQUÍ:**
        // En lugar de retornar el SVG directamente, pasamos el $profileUrl a la vista
        return view('tutor.share-profile', compact('profileUrl')); // Asegúrate de que esta vista sea la que quieres usar
    }
}
