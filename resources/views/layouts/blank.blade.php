<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- 👇 MUY IMPORTANTE para Livewire/Laravel -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>[x-cloak]{display:none!important}</style>
  
  <title>{{ $title ?? config('app.name','Turnero En Vivo UTN-FSA') }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  @livewireStyles
</head>
@stack('scripts')
<body class="antialiased bg-gray-100 dark:bg-slate-900 dark:text-gray-100">
  {{ $slot }}
  @livewireScripts
</body>
</html>
