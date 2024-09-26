<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngEgr extends Model
{
    use HasFactory;
    protected $table = 'ing_egr';
    protected $fillable = ['fecha', 'monto', 'descripcion', 'tipo', 'tipo_pago', 'tipo_doc', 'user_id', 'caja_id']; // Especifica los campos que pueden ser asignados masivamente

    public $timestamps = false;
}
