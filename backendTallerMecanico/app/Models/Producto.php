<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'producto_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'categoria_id',
        'fabricante_id',
        'nombre',
        'descripcion',
        'descuento',
        'precio_compra',
        'precio_venta',
        'producto_stock',
        'producto_stock_minimo',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'categoria_id');
    }

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class, 'fabricante_id', 'fabricante_id');
    }
}
