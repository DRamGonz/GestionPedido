<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'email', 'telefono',
    ];

    /**
     * Un cliente tiene muchos pedidos.
     * $cliente->pedidos  →  colección de Pedido
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}