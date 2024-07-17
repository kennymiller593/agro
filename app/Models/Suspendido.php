<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspendido extends Model
{
    use HasFactory;
    protected $table = 'suspendido';
    public $timestamps = false;
    protected $fillable = ['instalacion_id', 'fecha_suspendido', 'motivo'];
}
