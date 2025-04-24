<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $query = DB::table('campeones')
            ->where('creator', $userNickname)
            ->when($search, function ($q) use ($search) {
                return $q->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('name', $order);

        $campeones = $query->paginate($perPage);

        return response()->json([
            'view' => view('partials.champions-list', compact('campeones'))->render()
        ]);
    }

    public function edit($id)
    {
        $campeon = DB::table('campeones')->where('id', $id)->where('creator', Auth::user()->nickname)->first();

        if (!$campeon) abort(403);

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

        DB::table('campeones')->where('id', $id)->where('creator', Auth::user()->nickname)->update([
            'name' => $request->name,
            'description' => $request->description,
            'resource' => $request->resource,
            'role' => $request->role,
        ]);

        return redirect()->route('home-users')->with('success', 'Campió actualitzat correctament.');
    }

    public function destroy($id)
    {
        DB::table('campeones')->where('id', $id)->where('creator', Auth::user()->nickname)->delete();

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
    
        DB::table('campeones')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'resource' => $request->resource,
            'role' => $request->role,
            'creator' => Auth::user()->nickname,
        ]);
    
        return redirect()->route('home-users')->with('success', 'Campió creat correctament!');
    }
}

