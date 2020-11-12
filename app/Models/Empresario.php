<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresario extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'razon_social',
        'razon_social',
        'nombre',
        'pais',
        'tipo_moneda',
        'estado',
        'ciudad',
        'telefono',
        'email',
        'activo',
    ];
}
