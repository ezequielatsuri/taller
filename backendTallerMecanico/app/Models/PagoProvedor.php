<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoProvedor extends Model
{
    use HasFactory;

    // Especifica la tabla asociada con el modelo (opcional si el nombre es el plural del modelo)
    protected $table = 'pago_provedores';

    // Indica qué atributos se pueden asignar masivamente
    protected $fillable = [
        'provedor_id',
        'pago_id',
        'observaciones',
    ];

    // Define la relación con el modelo Provedor
    public function proveedor()
    {
        return $this->belongsTo(Provedor::class, 'provedor_id');
    }

    // Define la relación con el modelo Pago
    public function pago()
    {
        return $this->belongsTo(Pago::class, 'pago_id');
    }
}
