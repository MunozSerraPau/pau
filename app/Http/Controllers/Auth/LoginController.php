<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuari;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nickname' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar al usuario por nickname
        $usuari = Usuari::where('nickname', $credentials['nickname'])->first();

        // Comprobar si el usuario existe y verificar la contraseña
        if ($usuari && password_verify($credentials['password'], $usuari->contrasenya)) {
            Auth::login($usuari); // login manual
            $request->session()->regenerate();
            return redirect()->intended('home-user');
        }

        return back()->withErrors([
            'nickname' => 'Les credencials no són correctes.',
        ])->onlyInput('nickname');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
