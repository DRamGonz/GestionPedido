<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;

class ClienteService
{
    /**
     * Lista todos los clientes con el número de pedidos de cada uno.
     * withCount('pedidos') añade la columna pedidos_count al resultado.
     */
    public function todos(): Collection
    {
        return Cliente::withCount('pedidos')
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Solo id y nombre, para usar en selects del formulario de pedidos.
     */
    public function paraSelect(): Collection
    {
        return Cliente::orderBy('nombre')->get(['id', 'nombre']);
    }

    /**
     * Crea un nuevo cliente o actualiza uno existente (si se pasa $id).
     */
    public function guardar(array $datos, ?int $id = null): Cliente
    {
        if ($id) {
            $cliente = Cliente::findOrFail($id);
            $cliente->update($datos);
            return $cliente;
        }
        return Cliente::create($datos);
    }

    /**
     * Elimina un cliente. Por cascadeOnDelete, sus pedidos
     * se eliminan automáticamente en la base de datos.
     */
    public function eliminar(int $id): void
    {
        Cliente::findOrFail($id)->delete();
    }
}