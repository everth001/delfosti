<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        "nro_pedido",
        "producto_id",
        "fecha_pedido",
        "fecha_recepcion",
        "fecha_despacho",
        "fecha_entrega",
        "user_id",
        "repartidor",
        "estado_id",
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function getFechaPedidoAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getFechaRecepcionAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y H:i:s') : null;
    }

    public function getFechaDespachoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y H:i:s') : null;
    }

    public function getFechaEntregaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d/m/Y H:i:s') : null;
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}
