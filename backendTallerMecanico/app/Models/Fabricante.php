<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
    use HasFactory;

    // La tabla asociada al modelo
    protected $table = 'fabricantes';

    // La clave primaria de la tabla
    protected $primaryKey = 'fabricante_id';

    // Indicar si la clave primaria es un incremento automático
    public $incrementing = true;

    // El tipo de la clave primaria
    protected $keyType = 'int';

    // Deshabilitar los timestamps si no los necesitas
    public $timestamps = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Definir la relación con la tabla Producto
    public function productos()
    {
        return $this->hasMany(Producto::class, 'fabricante_id', 'fabricante_id');
    }
}
