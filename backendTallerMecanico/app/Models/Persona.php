<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';
    protected $primaryKey = 'persona_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido_pat',
        'apellido_mat',
        'correo',
        'sexo',
        'telefono',
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'persona_id', 'persona_id');
    }
}
