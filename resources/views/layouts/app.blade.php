<!DOCTYPE html>
<html lang="es"
      x-data="{ dark: localStorage.theme === 'dark' }"
      x-init="$watch('dark', v => { 
          localStorage.theme = v ? 'dark' : 'light'; 
          document.documentElement.classList.toggle('dark', v) 
      }); 
      document.documentElement.classList.toggle('dark', dark)">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Turnero En Vivo UTN-FSA') }}</title>

    <!-- Anti-flicker Alpine -->
    <style>[x-cloak]{display:none!important}</style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ✅ Livewire styles -->
    @livewireStyles
</head>
@stack('scripts')
<body class="font-sans antialiased bg-gray-100 dark:bg-slate-900 dark:text-gray-100">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Toggle Modo Oscuro/Claro -->
        <div class="flex justify-end px-4 py-2 bg-white dark:bg-slate-800 shadow">
            <button x-cloak
                    class="px-3 py-1 rounded border text-sm hover:bg-slate-100 dark:hover:bg-slate-700 border-slate-300 dark:border-slate-600"
                    x-on:click="dark = !dark" type="button">
                <span x-show="!dark">🌙 Oscuro</span>
                <span x-show="dark">☀️ Claro</span>
            </button>
        </div>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-slate-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- ✅ Livewire scripts -->
    @livewireScripts
    <!-- ✅ Config para v3 (no rompe v2) -->
    @livewireScriptConfig

    @stack('scripts')
</body>
</html>
