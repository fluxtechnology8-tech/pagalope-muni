<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    protected $fillable = [
        'contribuyente_id', 'anio_deuda', 'tributo', 'desc_tributo', 'cargo', 'abono', 'debe'
    ];

    // Declara la relación con Contribuyente
    public function contribuyente()
    {
        return $this->belongsTo(Contribuyente::class);
    }
}
