<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresa';
    protected $fillable = [
        'razon_social', 'ruc', 'descripcion', 'telefono', 'logo',
        'direccion', 'fecha_registro',
        'sol_user', 'sol_pass', 'cert_path',
        'client_id', 'client_secret',
        'estado'
    ]; // Especifica los campos que pueden ser asignados masivamente

    public $timestamps = false;
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
