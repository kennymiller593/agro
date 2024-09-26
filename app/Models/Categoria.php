<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';
    protected $fillable = ['nombre', 'descripcion', 'estado']; // Especifica los campos que pueden ser asignados masivamente

    public $timestamps = false;
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
