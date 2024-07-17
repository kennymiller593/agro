<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'planes';
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'instalacion', 'planes_id', 'cliente_id');
    }
}
