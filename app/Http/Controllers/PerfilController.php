<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        
        $user->update([
            'nom' => $request->nom,
            'cognoms' => $request->cognoms,
            'correu' => $request->correu,
        ]);

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

        if (!Hash::check($request->current_password, $user->contrasenya)) {
            return back()->withErrors(['current_password' => 'La contrasenya actual no és correcta']);
        }

        $user->contrasenya = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('home-users')->with('success', 'Contrasenya actualitzada correctament!');
    }
}
