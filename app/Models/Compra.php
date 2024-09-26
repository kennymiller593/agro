<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $table = 'compra';
    protected $fillable = ['tipo_movimiento', 'proveedor_id', 'fecha', 'total', 'usuario_id', 'caja_id'];
    public $timestamps = false;

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id');
    }
}
