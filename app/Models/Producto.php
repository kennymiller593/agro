<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';
    protected $fillable = ['nombre', 'codigo', 'descripcion', 'precio_venta', 'precio_compra', 'stok', 'estado', 'categoria_id', 'medida_id', 'imagen', 'sucursal_id', 'proveedor_id']; // Especifica los campos que pueden ser asignados masivamente

    public $timestamps = false;

    public function unimedida()
    {
        return $this->belongsTo(Medida::class, 'medida_id');
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
