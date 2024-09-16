<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaServicio extends Model
{
    use HasFactory;

    protected $table = 'venta_servicios';
    protected $primaryKey = 'venta_servicio_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'venta_id', 
        'tarea_id',
    ];

    // Definir relación con el modelo Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id', 'venta_id');
    }

    // Definir relación con el modelo Tarea
    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id', 'tarea_id');
    }
}
