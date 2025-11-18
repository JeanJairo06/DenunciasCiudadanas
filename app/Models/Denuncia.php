<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $table = 'denuncias';

    protected $fillable = [
        'titulo',
        'imagen',
        'descripcion',
        'ubicacion',
        'estado',
        'ciudadano',
        'telefono_ciudadano',
        'fecha_registro',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
    ];
}
