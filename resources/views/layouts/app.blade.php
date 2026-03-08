<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}{{ isset($title) ? ' — '.$title : '' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">

    <nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <div class="flex items-center gap-8">
                    {{-- Nombre de la app desde .env --}}
                    <a href="{{ route('dashboard') }}"
                       class="text-white font-bold text-lg tracking-tight hover:text-indigo-400 transition">
                        {{ config('app.name') }}
                    </a>

                    {{-- Links de navegación --}}
                    <div class="hidden sm:flex items-center gap-1">
                        <a href="{{ route('dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('dashboard') ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                            Inicio
                        </a>
                        <a href="{{ route('clientes') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('clientes') ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                            👤 Clientes
                        </a>
                        <a href="{{ route('pedidos') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ request()->routeIs('pedidos') ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                            📦 Pedidos
                        </a>
                    </div>
                </div>

                {{-- Usuario y logout --}}
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-400 hidden sm:block">
                        {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="text-sm text-gray-400 hover:text-white transition px-3 py-2 rounded-lg hover:bg-gray-800">
                            Salir →
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    @if(isset($header))
    <header class="bg-gray-900/50 border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            {{ $header }}
        </div>
    </header>
    @endif

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>