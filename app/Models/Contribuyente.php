<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribuyente extends Model
{
    protected $fillable = [
        'nombres_razon_social', 'dni_ruc', 'direccion_fiscal'
    ];

    // Declara la relación con Deuda
    public function deudas()
    {
        return $this->hasMany(Deuda::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
