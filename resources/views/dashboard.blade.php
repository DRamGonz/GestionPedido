<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-white">Panel de control</h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
            <p class="text-gray-400 text-sm">Bienvenido</p>
            <p class="text-white text-xl font-bold mt-1">{{ Auth::user()->name }}</p>
        </div>
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
            <p class="text-gray-400 text-sm">Clientes</p>
            <p class="text-white text-xl font-bold mt-1">
                {{ \App\Models\Cliente::count() }}
            </p>
        </div>
        <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
            <p class="text-gray-400 text-sm">Pedidos</p>
            <p class="text-white text-xl font-bold mt-1">
                {{ \App\Models\Pedido::count() }}
            </p>
        </div>
    </div>

    <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
        <h3 class="text-white font-semibold mb-4">Accesos rápidos</h3>
        <div class="flex gap-3 flex-wrap">
            <a href="{{ route('clientes') }}"
               class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm transition">
                👤 Gestionar Clientes
            </a>
            <a href="{{ route('pedidos') }}"
               class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm transition">
                📦 Gestionar Pedidos
            </a>
        </div>
    </div>
</x-app-layout>