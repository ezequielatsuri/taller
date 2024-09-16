<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'venta_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'cliente_id',
        'vehiculo_id',
        'fecha',
        'total',
        'observaciones',
    ];

    // Definir relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'cliente_id');
    }

    // Definir relación con el modelo Vehiculo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id', 'vehiculo_id');
    }

    // Definir relación con el modelo VentaProducto
    public function ventaProductos()
    {
        return $this->hasMany(VentaProducto::class, 'venta_id', 'venta_id');
    }

    // Definir relación con el modelo VentaServicio
    public function ventaServicios()
    {
        return $this->hasMany(VentaServicio::class, 'venta_id', 'venta_id');
    }

    // Definir relación con el modelo PagoCliente
    public function pagosClientes()
    {
        return $this->hasMany(PagoCliente::class, 'venta_id', 'venta_id');
    }
}
