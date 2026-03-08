<div>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold text-white">👤 Clientes</h2>
        <button wire:click="$set('mostrarFormulario', true)"
                class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
            + Nuevo Cliente
        </button>
    </div>

    @if($mostrarFormulario)
    <div class="bg-gray-900 border border-gray-700 rounded-xl p-6 mb-6">
        <h3 class="text-white font-semibold mb-5">
            {{ $clienteId ? '✏️ Editar' : '👤 Nuevo' }} Cliente
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nombre *</label>
                <input wire:model="nombre" type="text" placeholder="Nombre completo"
                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none placeholder-gray-500">
                @error('nombre') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Email</label>
                <input wire:model="email" type="email" placeholder="correo@ejemplo.com"
                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none placeholder-gray-500">
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Teléfono</label>
                <input wire:model="telefono" type="tel" placeholder="600 000 000"
                    class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2
                           focus:ring-2 focus:ring-indigo-500 focus:outline-none placeholder-gray-500">
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
            <thead class="border-b border-gray-800 bg-gray-900">
                <tr>
                    <th class="p-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Nombre</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</th>
                    <th class="p-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Teléfono</th>
                    <th class="p-4 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Pedidos</th>
                    <th class="p-4 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                @forelse($clientes as $c)
                <tr class="hover:bg-gray-800/40 transition">
                    <td class="p-4 text-white font-medium">{{ $c->nombre }}</td>
                    <td class="p-4 text-gray-400">{{ $c->email ?? '—' }}</td>
                    <td class="p-4 text-gray-400">{{ $c->telefono ?? '—' }}</td>
                    <td class="p-4 text-center">
                        <span class="bg-indigo-900/50 text-indigo-300 text-xs font-semibold px-2 py-1 rounded-full border border-indigo-800">
                            {{ $c->pedidos_count }}
                        </span>
                    </td>
                    <td class="p-4 flex justify-center gap-4">
                        <button wire:click="editar({{ $c->id }})"
                                class="text-indigo-400 hover:text-indigo-300 text-sm transition">✏️ Editar</button>
                        <button wire:click="eliminar({{ $c->id }})"
                                wire:confirm="¿Eliminar a {{ $c->nombre }} y todos sus pedidos?"
                                class="text-red-400 hover:text-red-300 text-sm transition">🗑️ Eliminar</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-500">No hay clientes registrados aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>