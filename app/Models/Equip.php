<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    protected $table = 'equips'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nom_equip',
        'creator',
        'data_creacio',
        'qrImage',
    ]; // Campos que puedes rellenar de forma masiva (mass-assignment)

    public $timestamps = false; // Si no tienes created_at y updated_at en la tabla, ponlo en false

    // Relación con campeones (muchos a muchos)
    public function campeons()
    {
        return $this->belongsToMany(CampeoApi::class, 'equip_campio', 'idEquip', 'idCampio');
    }
}
