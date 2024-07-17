<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;
    protected $table = 'detalle_venta';
    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio', 'descuento'];
    public $timestamps = false;
    public function productos()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
