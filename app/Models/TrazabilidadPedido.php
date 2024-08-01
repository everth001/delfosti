<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrazabilidadPedido extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_pedido",
        "producto",
        "tipo_fecha",
        "fecha",
        "user_id",
        "nombre_user",
        "repartidor",
        "estado"
    ];
}
