<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Services\PedidoService;
use App\Services\ClienteService;

#[Layout('layouts.app')]
class Pedidos extends Component
{
    protected PedidoService  $pedidoService;
    protected ClienteService $clienteService;

    public function boot(PedidoService $pedidoService, ClienteService $clienteService): void
    {
        $this->pedidoService  = $pedidoService;
        $this->clienteService = $clienteService;
    }

    public        $cliente_id   = '';
    public string $fecha        = '';
    public string $total        = '';
    public string $estado       = 'pendiente';

    public        $pedidoId          = null;
    public bool   $mostrarFormulario = false;

    protected function rules(): array
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'fecha'      => 'required|date',
            'total'      => 'required|numeric|min:0',
            'estado'     => 'required|in:pendiente,en_proceso,completado,cancelado',
        ];
    }

    public function render()
    {
        return view('livewire.pedidos', [
            'pedidos'  => $this->pedidoService->todos(),
            'clientes' => $this->clienteService->paraSelect(),
        ]);
    }

    public function guardar(): void
    {
        $this->pedidoService->guardar($this->validate(), $this->pedidoId);
        $this->limpiar();
    }

    public function editar(int $id): void
    {
        $p = $this->pedidoService->todos()->find($id);
        $this->pedidoId          = $p->id;
        $this->cliente_id        = $p->cliente_id;
        $this->fecha             = $p->fecha;
        $this->total             = $p->total;
        $this->estado            = $p->estado;
        $this->mostrarFormulario = true;
    }

    public function eliminar(int $id): void
    {
        $this->pedidoService->eliminar($id);
    }

    public function limpiar(): void
    {
        $this->reset(['cliente_id', 'fecha', 'total', 'pedidoId']);
        $this->estado            = 'pendiente';
        $this->mostrarFormulario = false;
        $this->resetValidation();
    }
}