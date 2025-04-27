<?php

namespace App\Http\Controllers;

use App\Models\Campeon;
use Illuminate\Http\Request;

class CampeonController extends Controller
{
    public function index()
    {
        $perPage = 9;
        $campeones = Campeon::getAllPaginated($perPage);

        return view('home', compact('campeones'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('perPage', 9);

        $campeones = Campeon::searchByName($query, $perPage);

        if ($request->ajax()) {
            return view('components.campeones-list', ['campeones' => $campeones]);
        }

        return view('home', compact('campeones'));
    }
}
