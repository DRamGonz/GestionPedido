<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Acceso</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-4">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white tracking-tight">
                {{ config('app.name') }}
            </h1>
            <p class="text-gray-400 text-sm mt-2">Introduce tus credenciales para acceder</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 shadow-2xl">

            @if (session('status'))
                <div class="mb-4 text-sm text-green-400 bg-green-900/30 border border-green-800 rounded-lg px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           required autofocus autocomplete="username"
                           placeholder="tu@email.com"
                           class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg
                                  px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500
                                  focus:border-transparent placeholder-gray-500">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Contraseña</label>
                    <input type="password" name="password"
                           required autocomplete="current-password"
                           placeholder="••••••••"
                           class="w-full bg-gray-800 border border-gray-700 text-white rounded-lg
                                  px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500
                                  focus:border-transparent placeholder-gray-500">
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-gray-400 cursor-pointer">
                        <input type="checkbox" name="remember"
                               class="rounded border-gray-600 bg-gray-800 text-indigo-500">
                        Recordarme
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-indigo-400 hover:text-indigo-300 transition">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold
                               py-3 rounded-lg transition duration-200">
                    Entrar
                </button>
            </form>
        </div>

        {{-- Sin link de registro. Acceso solo por admin vía Tinker --}}
        <p class="text-center text-gray-700 text-xs mt-6">
            {{ config('app.name') }} &copy; {{ date('Y') }}
        </p>

    </div>
</body>
</html>