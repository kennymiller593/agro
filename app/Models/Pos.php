<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;
    protected $table = 'venta';
    protected $fillable = [
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha',
        'igv',
        'total',
        'estado',
        'cliente_id',
        'usuario_id',
        'forma_pago',
        'tipo_pago',
        'ganancia_total',
        'caja_id'
    ];
    public $timestamps = false;

    public function detallesventa()
    {
        return $this->hasMany(Detalle::class, 'venta_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
