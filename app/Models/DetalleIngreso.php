<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    use HasFactory;

    protected $table = 'detalle_ingreso';

    protected $primaryKey = 'id_detalle_ingreso';

    public $timestamps = false;

    protected $fillable = ['id_ingreso', 'id_producto', 'cantidad', 'precio_compra', 'precio_venta'];

    protected $guarded = [];

    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class, 'id_ingreso');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
