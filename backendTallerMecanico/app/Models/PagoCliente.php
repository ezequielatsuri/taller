<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoCliente extends Model
{
    use HasFactory;

    protected $table = 'pago_clientes';
    protected $primaryKey = 'pago_cliente_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'venta_id',
        'cliente_id',
        'pago_id',
        'observaciones',
    ];

    // Definir relación con el modelo Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id', 'venta_id');
    }

    // Definir relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'cliente_id');
    }

    // Definir relación con el modelo Pago
    public function pago()
    {
        return $this->belongsTo(Pago::class, 'pago_id', 'pago_id');
    }
}
