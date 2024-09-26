<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedor';
    protected $fillable = ['razon_social', 'ruc', 'direccion', 'nombre_comercial', 'tipo_doc', 'telefono']; // Especifica los campos que pueden ser asignados masivamente

    public $timestamps = false;
}
