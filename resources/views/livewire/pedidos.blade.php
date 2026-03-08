<div>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold text-white">📦 Pedidos</h2>
        <button wire:click="$set('mostrarFormulario', true)"
                class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Nuevo Pedido
        </button>
    </div>

    @if($mostrarFormulario)
    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 mb-6">
        <h3 class="text-white font-semibold mb-5">
            {{ $pedidoId ? '✏️ Editar' : '📦 Nuevo' }} Pedido
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Select de cliente -- usa la relación hasMany en sentido inverso --}}
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-300 mb-1">Cliente *</label>
                <select wire:model="cliente_id"
                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">Seleccionar cliente...</option>
                    @foreach($clientes as $cl)
                        <option value="{{ $cl->id }}">{{ $cl->nombre }}</option>
                    @endforeach
                </select>
                @error('cliente_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Fecha *</label>
                <input wire:model="fecha" type="date"
                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                @error('fecha') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Total (€) *</label>
                <input wire:model="total" type="number" step="0.01" min="0" placeholder="0.00"
                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none placeholder-gray-500">
                @error('total') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Estado *</label>
                <select wire:model="estado"
                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="pendiente">Pendiente</option>
                    <option value="en_proceso">En proceso</option>
                    <option value="completado">Completado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
                @error('estado') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

        </div>
        <div class="mt-5 flex gap-3">
            <button wire:click="guardar"
                    class="bg-green-600 hover:bg-green-500 text-white px-5 py-2 rounded-lg text-sm font-medium transition">
                💾 Guardar
            </button>
            <button wire:click="limpiar"
                    class="bg-gray-700 hover:bg-gray-600 text-gray-200 px-5 py-2 rounded-lg text-sm font-medium transition">
                Cancelar
            </button>
        </div>
    </div>
    @endif

    <div class="bg-gray-900 border border-gray-800 rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="border-b border-gray-800">
                <tr>
                    <th class="p-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Cliente</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Fecha</th>
                    <th class="p-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                    <th class="p-4 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Estado</th>
                    <th class="p-4 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse($pedidos as $p)
                <tr class="hover:bg-gray-800/40 transition">
                    <td class="p-4 text-indigo-400 font-medium">
                        {{ $p->cliente->nombre }}
                    </td>
                    <td class="p-4 text-gray-400">
                        {{ \Carbon\Carbon::parse($p->fecha)->format('d/m/Y') }}
                    </td>
                    <td class="p-4 text-right text-white font-mono">
                        {{ number_format($p->total, 2) }} €
                    </td>
                    <td class="p-4 text-center">
                        @php
                            $badge = match($p->estado) {
                                'completado'  => 'bg-green-900/50 text-green-300 border-green-800',
                                'en_proceso'  => 'bg-yellow-900/50 text-yellow-300 border-yellow-800',
                                'cancelado'   => 'bg-red-900/50 text-red-300 border-red-800',
                                default       => 'bg-gray-700 text-gray-300 border-gray-600',
                            };
                            $label = match($p->estado) {
                                'en_proceso' => 'En proceso',
                                'completado' => 'Completado',
                                'cancelado'  => 'Cancelado',
                                default      => 'Pendiente',
                            };
                        @endphp
                        <span class="text-xs font-semibold px-2 py-1 rounded-full border {{ $badge }}">
                            {{ $label }}
                        </span>
                    </td>
                    <td class="p-4 flex justify-center gap-4">
                        <button wire:click="editar({{ $p->id }})"
                                class="text-indigo-400 hover:text-indigo-300 text-sm transition">✏️ Editar</button>
                        <button wire:click="eliminar({{ $p->id }})"
                                wire:confirm="¿Eliminar este pedido?"
                                class="text-red-400 hover:text-red-300 text-sm transition">🗑️ Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-500">No hay pedidos registrados aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>