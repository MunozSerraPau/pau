<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usuari;
use Illuminate\Http\Request;

class UsuariController extends Controller
{
    // Mostrar lista de usuarios (solo admins)
    public function index()
    {
        $usuaris = Usuari::paginate(10);
        return view('admin.usuaris.index', compact('usuaris'));
    }

    // Mostrar formulario para editar
    public function edit($nickname)
    {
        $usuari = Usuari::findOrFail($nickname);
        return view('admin.usuaris.edit', compact('usuari'));
    }

    // Guardar los cambios
    public function update(Request $request, $nickname)
    {
        $usuari = Usuari::findOrFail($nickname);

        $request->validate([
            'nom' => 'nullable|string|max:50',
            'cognoms' => 'required|string|max:100',
            'correu' => 'required|email|unique:usuaris,correu,' . $nickname . ',nickname',
            'administrador' => 'required|boolean',
        ]);

        $usuari->update([
            'nom' => $request->nom,
            'cognoms' => $request->cognoms,
            'correu' => $request->correu,
            'administrador' => $request->administrador,
        ]);

        return redirect()->route('admin.usuaris.index')->with('success', 'Usuari actualitzat correctament!');
    }
}
