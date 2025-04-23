<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campeon;
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

    public function userCampeones(Request $request)
    {
        $userNickname = Auth::user()->nom; // Obtener el nombre del usuario logueado
        $query = $request->input('query', '');
        $perPage = $request->input('perPage', 9); // Valor por defecto: 9
        $order = $request->input('order', 'asc'); // Valor por defecto: ascendente

        $campeones = Campeon::where('creator', $userNickname)
            ->where('name', 'like', '%' . $query . '%')
            ->orderBy('name', $order)
            ->paginate($perPage);

        // Asegúrate de pasar todas las variables necesarias a la vista
        return view('home-user', compact('campeones', 'perPage', 'order', 'query'));
    }

    // ...existing code...
}