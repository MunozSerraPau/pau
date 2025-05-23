<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    // Mostrar formulario para editar perfil
    public function edit()
    {
        $user = Auth::user();
        return view('perfil.edit', compact('user'));
    }

    // Actualizar datos del perfil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nom' => 'nullable|string|max:50',
            'cognoms' => 'required|string|max:100',
            'correu' => 'required|email|unique:usuaris,correu,' . $user->nickname . ',nickname',
        ]);

        // Usamos el Modelo para actualizar perfil
        $user->updateProfile($request->nom, $request->cognoms, $request->correu);

        return redirect()->route('home-users')->with('success', 'Perfil actualitzat correctament!');
    }

    // Formulario para cambiar contraseña
    public function editPassword()
    {
        return view('perfil.password');
    }

    // Guardar nueva contraseña
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'confirmed'
            ],
        ]);

        $user = Auth::user();

        $result = $user->updatePassword($request->current_password, $request->new_password);

        if ($result === false) {
            return back()->withErrors(['current_password' => 'La contrasenya actual no és correcta']);
        }

        return redirect()->route('home-users')->with('success', 'Contrasenya actualitzada correctament!');
    }
}
