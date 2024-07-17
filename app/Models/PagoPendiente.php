<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoPendiente extends Model
{
    use HasFactory;
    protected $table = 'pendientes';
    public $timestamps = false;
    protected $fillable = ['instalacion_id', 'fecha_emision', 'fecha_vencimiento', 'descripcion', 'cantidad', 'precio', 'total', 'estado'];

    public function instalacion()
    {
        return  $this->belongsTo(Instalacion::class);
    }
}
