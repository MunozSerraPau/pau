<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campeon extends Model
{
    protected $table = 'campeones';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'resource',
        'role',
        'creator',
    ];

    // Paginar todos los campeones
    public static function getAllPaginated($perPage = 9)
    {
        return self::paginate($perPage);
    }
 
    // Buscar campeones por nombre y paginar
    public static function searchByName($query, $perPage = 9)
    {
        if ($query) {
            return self::where('name', 'like', '%' . $query . '%')->paginate($perPage);
        }
 
        return self::paginate($perPage);
    }

    // 🔥 Nueva función para filtrar + ordenar + paginar
    public static function filterAndPaginate($search = '', $sortOrder = 'asc', $perPage = 9)
    {
        return self::where('name', 'like', '%' . $search . '%')
                    ->orderBy('name', $sortOrder)
                    ->paginate($perPage);
    }

    // Buscar solo campeones del creador con filtro, orden y paginación
    public static function filterByCreator($creator, $search = '', $order = 'asc', $perPage = 9)
    {
        return self::where('creator', $creator)
                    ->when($search, function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orderBy('name', $order)
                    ->paginate($perPage);
    }

    // Buscar un campeón por ID y creador
    public static function findByCreator($id, $creator)
    {
        return self::where('id', $id)
                    ->where('creator', $creator)
                    ->first();
    }

    // Actualizar un campeón si es del creador
    public static function updateByCreator($id, $creator, array $data)
    {
        return self::where('id', $id)
                    ->where('creator', $creator)
                    ->update($data);
    }

    // Eliminar un campeón si es del creador
    public static function deleteByCreator($id, $creator)
    {
        return self::where('id', $id)
                    ->where('creator', $creator)
                    ->delete();
    }

    // Crear campeón para un creador
    public static function createForCreator(array $data)
    {
        return self::create($data);
    }
}
