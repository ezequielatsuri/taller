<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';
    protected $primaryKey = 'tarea_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nota',
        'fecha_inicio',
        'fecha_fin',
    ];

    // Definir relación con el modelo VentaServicio
    public function ventaServicios()
    {
        return $this->hasMany(VentaServicio::class, 'tarea_id', 'tarea_id');
    }
}
