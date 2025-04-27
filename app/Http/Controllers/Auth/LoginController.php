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
        $attempts = $request->session()->get('login_attempts', 0);
        $lastAttempt = $request->session()->get('login_last_attempt');

        if ($lastAttempt && now()->diffInMinutes($lastAttempt) >= 10) {
            $request->session()->forget(['login_attempts', 'login_last_attempt']);
            $attempts = 0;
        }

        // Primero, validar nickname y password solamente
        $credentials = $request->validate([
            'nickname' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ahora, validar reCAPTCHA solo si el usuario lleva 3 o más intentos
        if ($attempts >= 3) {
            if (!$request->has('g-recaptcha-response')) {
                return back()->withErrors([
                    'g-recaptcha-response' => 'El reCAPTCHA es obligatorio después de 3 intentos fallidos.',
                ])->onlyInput('nickname');
            }

            $request->validate([
                'g-recaptcha-response' => 'required|captcha',
            ]);
        }

        $usuari = Usuari::findByNickname($credentials['nickname']);

        if ($usuari && password_verify($credentials['password'], $usuari->contrasenya)) {
            Auth::login($usuari);
            $request->session()->regenerate();
            $request->session()->forget(['login_attempts', 'login_last_attempt']);
            $response = redirect()->intended('home-users');

            if ($request->has('remember_nickname')) {
                $response->withCookie(cookie('nickname', $credentials['nickname'], 60 * 24));
            } else {
                $response->withoutCookie('nickname');
            }

            return $response;
        }

        $request->session()->put('login_attempts', $attempts + 1);
        $request->session()->put('login_last_attempt', now());

        return back()->withErrors([
            'nickname' => 'Les credencials no són correctes.',
        ])->onlyInput('nickname');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('login_attempts'); // Intents 0
        return redirect('/');
    }
}
