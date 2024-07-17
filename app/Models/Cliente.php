<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $fillable = ['nombres', 'apellidos', 'tipo_persona', 'tipo_doc', 'num_doc', 'direccion', 'telefono']; // Especifica los campos que pueden ser asignados masivamente

    public $timestamps = false;

   
}
