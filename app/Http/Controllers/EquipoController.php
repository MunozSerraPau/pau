<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EquipoController extends Controller
{
    public function index()
    {
        $response = Http::get('https://ddragon.leagueoflegends.com/cdn/14.20.1/data/es_ES/champion.json');
        $champions = $response->json()['data'];

        return view('equipos.index', compact('champions'));
    }

    public function create()
    {
        $response = Http::get('https://ddragon.leagueoflegends.com/cdn/14.20.1/data/es_ES/champion.json');
        $champions = $response->json()['data'];

        return view('equipos.create', compact('champions'));
    }

    public function store(Request $request)
    {
        $selectedChampions = $request->input('champions', []);

        if (count($selectedChampions) > 5) {
            return back()->withErrors(['champions' => 'Solo puedes seleccionar un máximo de 5 campeones.']);
        }

        // Aquí podrías guardar el equipo seleccionado en la base de datos

        return redirect()->route('equipos.index')->with('success', 'Equipo creado exitosamente.');
    }
}
