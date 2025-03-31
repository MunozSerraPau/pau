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
}
