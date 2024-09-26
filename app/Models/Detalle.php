<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;
    protected $table = 'detalle_venta';
    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio', 'descuento', 'costo_venta', 'ganancia'];
    public $timestamps = false;
    public function productos()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
    public function venta()
    {
        return $this->belongsTo(Pos::class, 'venta_id');
    }
   
    
}
