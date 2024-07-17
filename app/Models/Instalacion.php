<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
    use HasFactory;
    protected $table = 'instalacion';
    protected $fillable = ['cliente_id', 'plan_id', 'fecha_instalacion', 'dia_cobro', 'zona_id', 'users_id', 'ip', 'estado', 'direccion', 'url_maps']; // Especifica los campos que pueden ser asignados masivamente
    public $timestamps = false;
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
    public function pagoPendiente()
    {
        return $this->hasMany(PagoPendiente::class);
    }
}
