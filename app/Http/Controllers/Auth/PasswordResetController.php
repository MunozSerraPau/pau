<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['correu' => 'required|email']);

        $usuari = Usuari::where('correu', $request->correu)->first();

        if ($usuari) {
            $token = Str::random(64);
            $usuari->token_recuperar = $token;
            $usuari->token_expiration = Carbon::now()->addMinutes(10);
            $usuari->save();

            $link = url("/reset-password?token=$token");

            Mail::raw("Fes clic aquí per restablir la teva contrasenya: $link", function ($message) use ($usuari) {
                $message->to($usuari->correu)
                        ->subject('Restablir contrasenya');
            });
        }

        return back()->with('status', 'Si el correu existeix, s’ha enviat un enllaç de recuperació.');
    }

    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $usuari = Usuari::where('token_recuperar', $request->token)
                        ->where('token_expiration', '>', Carbon::now())
                        ->first();

        if (!$usuari) {
            return back()->withErrors(['token' => 'Token invàlid o caducat.']);
        }

        $usuari->contrasenya = password_hash($request->password, PASSWORD_DEFAULT);
        $usuari->token_recuperar = null;
        $usuari->token_expiration = null;
        $usuari->save();

        return redirect('/login')->with('status', 'Contrasenya canviada correctament.');
    }
}
