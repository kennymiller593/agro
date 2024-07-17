<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = 'pago';
    protected $fillable = ['monto_total', 'fecha_pago', 'medio_pago', 'instalacion_id', 'pendiente_id'];
    public $timestamps = false;

    public function instalacion()
    {
        return $this->belongsTo(Instalacion::class);
    }
}
