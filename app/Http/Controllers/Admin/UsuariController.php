<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuari;

class UsuariController extends Controller
{
    public function __construct()
    {        
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->administrador != 1) {
                abort(403, 'Accés no autoritzat');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $usuaris = Usuari::getAllOrdered();
        return view('admin.usuaris.index', compact('usuaris'));
    }

    public function destroy($nickname)
    {
        $result = Usuari::deleteByNickname($nickname);

        if ($result === 'is_admin') {
            return redirect()->route('admin.usuaris.index')->with('error', 'No pots eliminar un administrador.');
        }

        return redirect()->route('admin.usuaris.index')->with('success', 'Usuari eliminat correctament.');
    }
}
