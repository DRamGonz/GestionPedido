<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'fecha', 'total', 'estado',
    ];

    /**
     * Un pedido pertenece a un cliente.
     * $pedido->cliente  →  instancia de Cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}