<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Services\ClienteService;

#[Layout('layouts.app')]
class Clientes extends Component
{
    // En lugar de __construct, usamos boot()
    protected ClienteService $service;

    public function boot(ClienteService $service): void
    {
        $this->service = $service;
    }

    public string $nombre   = '';
    public string $email    = '';
    public string $telefono = '';

    public $clienteId           = null;
    public bool $mostrarFormulario = false;

    protected function rules(): array
    {
        return [
            'nombre'   => 'required|min:2',
            'email'    => 'nullable|email',
            'telefono' => 'nullable',
        ];
    }

    public function render()
    {
        return view('livewire.clientes', [
            'clientes' => $this->service->todos(),
        ]);
    }

    public function guardar(): void
    {
        $this->service->guardar($this->validate(), $this->clienteId);
        $this->limpiar();
    }

    public function editar(int $id): void
    {
        $c = $this->service->todos()->find($id);
        $this->clienteId         = $c->id;
        $this->nombre            = $c->nombre;
        $this->email             = $c->email ?? '';
        $this->telefono          = $c->telefono ?? '';
        $this->mostrarFormulario = true;
    }

    public function eliminar(int $id): void
    {
        $this->service->eliminar($id);
    }

    public function limpiar(): void
    {
        $this->reset(['nombre', 'email', 'telefono', 'clienteId']);
        $this->mostrarFormulario = false;
        $this->resetValidation();
    }
}