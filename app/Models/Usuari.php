<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class Usuari extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuaris';
    protected $primaryKey = 'nickname'; // si el login será con nickname
    public $incrementing = false;
    protected $keyType = 'string'; // ya que nickname no es numérico
    public $timestamps = false;

    protected $fillable = [
        'nom', 'cognoms', 'correu', 'nickname', 'contrasenya', 'xarxa_social', 'administrador', 'imgPerfil'
    ];

    protected $hidden = ['contrasenya'];

    // override default password field
    public function getAuthPassword()
    {
        return $this->contrasenya;
    }

    public function getAuthIdentifierName()
    {
        return 'nickname';
    }

    // Nuevo método para encontrar usuario por nickname
    public static function findByNickname(string $nickname)
    {
        return self::where('nickname', $nickname)->first();
    }

    // Método para buscar por correo electrónico
    public static function findByEmail(string $email)
    {
        return self::where('correu', $email)->first();
    }

    // Genera un token de recuperación de contraseña
    public function generatePasswordResetToken()
    {
        $token = Str::random(64);
        $this->token_recuperar = $token;
        $this->token_expiration = Carbon::now()->addMinutes(10);
        $this->save();

        return $token;
    }

    // Encuentra un usuario por token válido
    public static function findValidToken(string $token)
    {
        return self::where('token_recuperar', $token)
                    ->where('token_expiration', '>', Carbon::now())
                    ->first();
    }

    // Resetea la contraseña
    public function resetPassword(string $newPassword)
    {
        $this->contrasenya = password_hash($newPassword, PASSWORD_DEFAULT);
        $this->token_recuperar = null;
        $this->token_expiration = null;
        $this->save();
    }

    // Registra un nuevo usuario
    public static function registerNewUser($nom, $cognoms, $correu, $nickname, $contrasenya, $imgPerfil = '/vistaGlobal/imgPerfil/default.png')
    {
        self::create([
            'nom' => $nom,
            'cognoms' => $cognoms,
            'correu' => $correu,
            'nickname' => $nickname,
            'contrasenya' => password_hash($contrasenya, PASSWORD_DEFAULT),
            'xarxa_social' => '',
            'administrador' => 0,
            'imgPerfil' => $imgPerfil,
            'token_recuperar' => null,
            'token_expiration' => null,
        ]);
    }

    // Obtener todos los usuarios ordenados por nickname
    public static function getAllOrdered()
    {
        return self::orderBy('nickname')->get();
    }

    // Eliminar un usuario por su nickname (si no es administrador)
    public static function deleteByNickname(string $nickname)
    {
        $usuari = self::where('nickname', $nickname)->first();

        if (!$usuari) {
            return 'not_found';
        }

        if ($usuari->administrador == 1) {
            return 'is_admin';
        }

        $usuari->delete();
        return 'deleted';
    }

    // Actualizar perfil del usuario
    public function updateProfile(?string $nom, string $cognoms, string $correu)
    {
        $this->update([
            'nom' => $nom,
            'cognoms' => $cognoms,
            'correu' => $correu,
        ]);
    }

    // Actualizar la contraseña del usuario
    public function updatePassword(string $currentPassword, string $newPassword)
    {
        if (!Hash::check($currentPassword, $this->contrasenya)) {
            return false;
        }

        $this->contrasenya = Hash::make($newPassword);
        $this->save();

        return true;
    }

    // Comprobar si el usuario es administrador
    public function isAdmin()
    {
        return $this->administrador == 1;
    }
}
