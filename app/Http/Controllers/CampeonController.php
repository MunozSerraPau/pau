<?php

namespace App\Http\Controllers;

use App\Models\Campeon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampeonController extends Controller
{
    // ...existing code...

    public function index()
    {
        $perPage = 9; // Por defecto, 9 campeones por página.
        $campeones = Campeon::paginate($perPage); // Usamos paginación.

        return view('home', compact('campeones')); // Pasamos la variable $campeones.
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('perPage', 9); // Por defecto, 9 campeones por página.

        $campeones = $query 
            ? Campeon::where('name', 'like', '%' . $query . '%')->paginate($perPage)
            : Campeon::paginate($perPage); // Usamos paginación.

        if ($request->ajax()) {
            return view('components.campeones-list', ['campeones' => $campeones]);
        }

        // Asegúrate de pasar la variable $campeones a la vista.
        return view('home', compact('campeones'));
    }

    // ...existing code...
}