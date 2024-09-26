<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresa';
    protected $fillable = ['razon_social', 'ruc', 'logo','direccion','telefono','nombre_comercial','descripcion']; // Especifica los campos que pueden ser asignados masivamente

    public $timestamps = false;
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
