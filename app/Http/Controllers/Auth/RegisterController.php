<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuari;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'cognoms' => 'required|string|max:100',
            'correu' => 'required|email|max:150|unique:usuaris,correu',
            'nickname' => 'required|string|max:50|unique:usuaris,nickname',
            'contrasenya' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/[A-Z]/', $value)) {
                        $fail('La contrasenya ha de contenir almenys una majúscula.');
                    }
                    if (!preg_match('/[a-z]/', $value)) {
                        $fail('La contrasenya ha de contenir almenys una minúscula.');
                    }
                    if (!preg_match('/[0-9]/', $value)) {
                        $fail('La contrasenya ha de contenir almenys un número.');
                    }
                    if (!preg_match('/[\W_]/', $value)) {
                        $fail('La contrasenya ha de contenir almenys un caràcter especial.');
                    }
                }
            ],
            'imgPerfil' => 'nullable|image|max:2048', // Opcional, máx 2MB
        ]);

        $imgPath = '/vistaGlobal/imgPerfil/default.png';

        if ($request->hasFile('imgPerfil')) {
            $img = $request->file('imgPerfil');
            $filename = uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('vistaGlobal/imgPerfil'), $filename);
            $imgPath = '/vistaGlobal/imgPerfil/' . $filename;
        }

        // Usamos el Modelo para registrar al usuario
        Usuari::registerNewUser(
            $request->nom,
            $request->cognoms,
            $request->correu,
            $request->nickname,
            $request->contrasenya,
            $imgPath
        );

        return redirect()->route('login')->with('success', 'Compte creat correctament. Pots iniciar sessió.');
    }
}
