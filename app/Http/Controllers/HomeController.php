<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campeon;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function fetchCampeones(Request $request)
    {
        $perPage = $request->input('per_page', 9);
        $sortOrder = $request->input('sort', 'asc');
        $search = $request->input('search', '');

        $campeones = Campeon::filterAndPaginate($search, $sortOrder, $perPage);

        return view('partials.campeones', compact('campeones'))->render();
    }
}
