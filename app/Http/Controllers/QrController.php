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


    public function  generateQr()
    {
        $qrCode = QrCode::size(250)
            ->color(92, 173, 226)
            ->generate('EDUTeam, Tu plataforma de tutorias en linea');
        // para devolver respuesta
        // return response($qrCode)->header('Content-Type', 'image/svg+xml');

        return view('tutor.share-profile', compact('qrCode'));
    }
}
