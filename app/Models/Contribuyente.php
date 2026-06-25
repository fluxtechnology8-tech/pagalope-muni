<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribuyente extends Model
{
    protected $fillable = [
        'user_id', 'nombres_razon_social', 'dni_ruc', 'direccion_fiscal'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
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
