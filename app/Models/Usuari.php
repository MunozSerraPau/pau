<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}
