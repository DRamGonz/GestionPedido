<?php

namespace App\Services;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Collection;

class PedidoService
{
    /**
     * Lista todos los pedidos cargando el cliente relacionado.
     * with('cliente') = eager loading: una sola consulta SQL,
     * evita hacer N consultas adicionales para cada fila.
     */
    public function todos(): Collection
    {
        return Pedido::with('cliente')
            ->latest()
            ->get();
    }

    /**
     * Crea o actualiza un pedido.
     */
    public function guardar(array $datos, ?int $id = null): Pedido
    {
        if ($id) {
            $pedido = Pedido::findOrFail($id);
            $pedido->update($datos);
            return $pedido;
        }
        return Pedido::create($datos);
    }

    /**
     * Elimina un pedido.
     */
    public function eliminar(int $id): void
    {
        Pedido::findOrFail($id)->delete();
    }
}