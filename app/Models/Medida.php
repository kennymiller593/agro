<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;
    protected $table = 'medida';
    protected $fillable = ['nombre', 'simbolo', 'estado']; // Especifica los campos que pueden ser asignados masivamente

    public $timestamps = false;
}
