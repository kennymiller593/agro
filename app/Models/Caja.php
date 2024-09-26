<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    protected $table = 'arqueo_caja';
    protected $fillable = ['fecha_arqueo', 'fecha_apertura', 'saldo_inicial', 'total_ingresos',
    'total_egresos', 'saldo_final',  'diferencia', 'observaciones', 'estado', 'usuario_id']; // Especifica los campos que pueden ser asignados masivamente

    public $timestamps = false;
}
