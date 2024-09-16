<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'pago_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'num_comprobante',
        'cantidad_pago',
        'descuento',
        'fecha',
        'observaciones',
    ];

    // Definir relaciones
    // Añade relaciones si es necesario
}
