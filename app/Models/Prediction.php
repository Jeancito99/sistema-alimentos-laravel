<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    // Habilitamos las columnas para que Laravel permita guardarlas con ::create()
    protected $fillable = [
        'temperatura',
        'humedad',
        'dias_restantes',
        'estado'
    ];
}
