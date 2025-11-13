{{-- resources/views/livewire/kiosco-turnos.blade.php --}}
<div class="min-h-screen bg-gray-100 dark:bg-slate-900 dark:text-gray-100">
  {{-- Barra superior --}}
  <header class="border-b bg-white/80 dark:bg-slate-800/80 backdrop-blur border-slate-200 dark:border-slate-700">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <div>
        <p class="text-xs tracking-wider text-slate-500 dark:text-slate-300">Turnero En Vivo</p>
        <h1 class="text-2xl font-black">UTN - Subsede Formosa.</h1>
      </div>

      {{-- Toggle tema --}}
      <button x-cloak
              class="px-3 py-1 rounded border text-sm hover:bg-slate-100 dark:hover:bg-slate-700 border-slate-300 dark:border-slate-600"
              x-on:click="dark = !dark">
        <span x-show="!dark">🌙 Oscuro</span>
        <span x-show="dark">☀️ Claro</span>
      </button>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6 py-8 space-y-8">
    {{-- Intro --}}
    <section class="rounded-2xl border bg-white dark:bg-slate-800 dark:border-slate-700 p-6">
      <div class="flex items-start justify-between gap-4">
        <div>
          <h2 class="text-lg font-semibold">Elegí el servicio</h2>
          <p class="text-sm text-slate-500 dark:text-slate-300">
            Tocá “Turno” o “Prioritario”. Tu número aparecerá abajo y lo verás en <strong>/pantalla</strong> cuando te llamen.
          </p>
        </div>
        <div class="text-right text-sm text-slate-500 dark:text-slate-300">
          <div>{{ now()->format('d/m/Y') }}</div>
          <div x-data="{h:''}" x-init="setInterval(()=>h=new Date().toLocaleTimeString('es-AR'),1000)">
            <span x-text="h"></span>
          </div>
        </div>
      </div>
    </section>

    {{-- Grid de servicios --}}
    <section class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
      @foreach($servicios as $s)
        <article class="rounded-2xl border bg-white dark:bg-slate-800 dark:border-slate-700 shadow-sm p-5 flex flex-col">
          <div class="mb-3">
            <div class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400">Servicio</div>
            <div class="text-lg font-semibold">{{ $s->nombre }}</div>
            <div class="text-xs text-slate-400">Código: {{ $s->codigo }}</div>
          </div>

          <div class="mt-auto flex gap-2">
            <button wire:click="generar({{ $s->id }}, false)"
              class="flex-1 px-4 py-2 rounded-lg bg-emerald-600 text-white font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400">
              Turno
            </button>
            <button wire:click="generar({{ $s->id }}, true)"
              class="flex-1 px-4 py-2 rounded-lg bg-amber-600 text-white font-medium hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-400">
              Prioritario
            </button>
          </div>
        </article>
      @endforeach
    </section>

    {{-- Resultado del ticket generado --}}
    @if($ticketGenerado)
      <section
        class="rounded-2xl border bg-emerald-50 dark:bg-emerald-900/30 border-emerald-300 dark:border-emerald-700 p-6 text-center">
        <p class="text-sm text-emerald-800 dark:text-emerald-200">Tu número es</p>
        <div class="text-5xl font-black tracking-wide text-emerald-900 dark:text-emerald-100">
          {{ $ticketGenerado }}
        </div>
        <p class="text-sm mt-1 text-emerald-800 dark:text-emerald-200">
          Aguardá a ser llamado en pantalla.
        </p>
      </section>
    @endif
  </main>
</div>
