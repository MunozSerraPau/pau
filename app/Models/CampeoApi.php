<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampeoApi extends Model
{
    protected $table = 'campeons_api'; // Nombre exacto de la tabla en la base de datos

    protected $fillable = [
        'nameCampio',
        'tagsCampio',
        'imgCampio',
    ]; // Campos que puedes asignar en masa

    public $timestamps = false; // No tienes columnas created_at ni updated_at

    // Relación con equipos (muchos a muchos)
    public function equips()
    {
        return $this->belongsToMany(Equip::class, 'equip_campio', 'idCampio', 'idEquip');
    }
}
