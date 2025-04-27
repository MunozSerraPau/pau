<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campeon;

class CampeonControllerLogin extends Controller
{
    public function index(Request $request)
    {
        return view('home-users');
    }

    public function ajax(Request $request)
    {
        $userNickname = Auth::user()->nickname;

        $perPage = $request->get('perPage', 9);
        $order = $request->get('order', 'asc');
        $search = $request->get('search', '');

        $campeones = Campeon::filterByCreator($userNickname, $search, $order, $perPage);

        return response()->json([
            'view' => view('partials.champions-list', compact('campeones'))->render()
        ]);
    }

    public function edit($id)
    {
        $campeon = Campeon::findByCreator($id, Auth::user()->nickname);

        if (!$campeon) {
            abort(403);
        }

        return view('campeones.edit', compact('campeon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'resource' => 'required|max:30',
            'role' => 'required|max:30',
        ]);

        Campeon::updateByCreator($id, Auth::user()->nickname, [
            'name' => $request->name,
            'description' => $request->description,
            'resource' => $request->resource,
            'role' => $request->role,
        ]);

        return redirect()->route('home-users')->with('success', 'Campió actualitzat correctament.');
    }

    public function destroy($id)
    {
        Campeon::deleteByCreator($id, Auth::user()->nickname);

        return redirect()->route('home-users')->with('success', 'Campió eliminat correctament.');
    }

    public function create()
    {
        return view('campeones.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:campeones,name',
            'description' => 'required',
            'resource' => 'required|max:30',
            'role' => 'required|max:30',
        ]);

        Campeon::createForCreator([
            'name' => $request->name,
            'description' => $request->description,
            'resource' => $request->resource,
            'role' => $request->role,
            'creator' => Auth::user()->nickname,
        ]);        

        return redirect()->route('home-users')->with('success', 'Campió creat correctament!');
    }
}
