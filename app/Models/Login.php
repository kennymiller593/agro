<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $table = 'usuario';
    public $timestamps = false;
    protected $fillable = ['nombres', 'apellidos', 'username', 'clave'];
}
