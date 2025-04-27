<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campeon;

class CampeonController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function ajax(Request $request)
    {
        $perPage = $request->get('perPage', 9);
        $order = $request->get('order', 'asc');
        $search = $request->get('search', '');

        $campeones = Campeon::filterAndPaginate($search, $order, $perPage);

        return response()->json([
            'view' => view('partials.champions-list-home', compact('campeones'))->render()
        ]);
    }
}
