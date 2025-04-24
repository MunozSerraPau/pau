<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:50',
            'cognoms' => 'required|string|max:100',
            'correu' => 'required|email|max:150|unique:usuaris,correu',
            'nickname' => 'required|string|max:50|unique:usuaris,nickname',
            'contrasenya' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/[A-Z]/', $value)) {
                        $fail('La contrasenya ha de contenir almenys una majúscula.');
                    }
                    if (!preg_match('/[a-z]/', $value)) {
                        $fail('La contrasenya ha de contenir almenys una minúscula.');
                    }
                    if (!preg_match('/[0-9]/', $value)) {
                        $fail('La contrasenya ha de contenir almenys un número.');
                    }
                    if (!preg_match('/[\W_]/', $value)) {
                        $fail('La contrasenya ha de contenir almenys un caràcter especial.');
                    }
                }
            ],
            'imgPerfil' => 'nullable|image|max:2048', // Opcional, máx 2MB
        ]);
    
        $imgPath = '/vistaGlobal/imgPerfil/default.png';
    
        if ($request->hasFile('imgPerfil')) {
            $img = $request->file('imgPerfil');
            $filename = uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('vistaGlobal/imgPerfil'), $filename);
            $imgPath = '/vistaGlobal/imgPerfil/' . $filename;
        }
    
        DB::table('usuaris')->insert([
            'nom' => $request->nom,
            'cognoms' => $request->cognoms,
            'correu' => $request->correu,
            'nickname' => $request->nickname,
            'contrasenya' => password_hash($request->contrasenya, PASSWORD_DEFAULT),
            'xarxa_social' => '',
            'administrador' => 0,
            'imgPerfil' => $imgPath,
            'token_recuperar' => null,
            'token_expiration' => null,
        ]);
    
        return redirect()->route('login')->with('success', 'Compte creat correctament. Pots iniciar sessió.');
    }
}
