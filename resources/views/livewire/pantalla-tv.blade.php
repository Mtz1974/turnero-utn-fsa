{{-- resources/views/livewire/pantalla-tv.blade.php --}}
<div wire:poll.3s
     class="min-h-screen bg-slate-900 text-white flex flex-col">

  {{-- HEADER --}}
  <header class="w-full bg-slate-800 border-b border-slate-700">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <h1 class="text-2xl sm:text-3xl font-black tracking-wide">
        Turnero En Vivo <span class="text-sky-400">UTN-FSA</span>
      </h1>
      <div class="text-right">
        <div class="text-xs uppercase text-slate-400">Hoy</div>
        <div class="text-lg font-semibold" x-data="{h:''}" x-init="setInterval(()=>h=new Date().toLocaleString('es-AR',{hour12:false}),1000)">
          <span x-text="h"></span>
        </div>
      </div>
    </div>
  </header>

  {{-- CONTENIDO --}}
  <main class="flex-1 max-w-7xl mx-auto w-full px-6 py-6 grid grid-cols-12 gap-6">

    {{-- TABLERO IZQUIERDA: últimos llamados --}}
    <section class="col-span-12 md:col-span-5">
      <div class="rounded-2xl overflow-hidden border border-slate-700">
        <div class="bg-red-600 px-4 py-3">
          <div class="flex justify-between text-sm font-bold tracking-widest">
            <span>TURNOS</span>
            <span>MÓDULO</span>
          </div>
        </div>

        <div class="bg-slate-800 divide-y divide-slate-700">
          @forelse($llamados as $t)
            @php
              $codigo = ($t->servicio?->codigo ?? '') . str_pad($t->numero,3,'0',STR_PAD_LEFT);
              $modulo = $t->puesto_id ?? '—';
            @endphp
            <div class="px-4 py-4 flex items-center justify-between">
              <div class="flex items-baseline gap-3">
                <span class="text-slate-400 text-xs">{{ $t->servicio?->codigo }}</span>
                <span class="text-2xl font-extrabold tracking-widest">
                  {{ $codigo }}
                </span>
                @if($t->prioritario)
                  <span class="ml-2 text-[10px] px-2 py-0.5 rounded-full bg-amber-500 text-black font-bold">PRIO</span>
                @endif
              </div>
              <div class="text-2xl font-black tabular-nums">
                {{ $modulo }}
              </div>
            </div>
          @empty
            <div class="px-4 py-6 text-center text-slate-400">
              Sin llamados recientes
            </div>
          @endforelse
        </div>
      </div>

      {{-- Próximos (opcional) --}}
      @if($cola->isNotEmpty())
        <div class="mt-6 rounded-2xl border border-slate-700">
          <div class="px-4 py-2 bg-slate-800 text-xs text-slate-300 tracking-wider">
            Próximos en cola
          </div>
          <div class="p-4 flex flex-wrap gap-2">
            @foreach($cola as $t)
              @php $codigo = ($t->servicio?->codigo ?? '') . str_pad($t->numero,3,'0',STR_PAD_LEFT); @endphp
              <span class="text-sm px-3 py-1 rounded-lg bg-slate-700/60">
                {{ $codigo }}
              </span>
            @endforeach
          </div>
        </div>
      @endif
    </section>

    {{-- PANEL DERECHO: LLAMANDO + imagen/mensaje --}}
    <section class="col-span-12 md:col-span-7 grid grid-rows-6 gap-6">
      {{-- Llamando --}}
      <div class="row-span-3 rounded-2xl border border-slate-700 overflow-hidden">
        <div class="bg-slate-800 px-4 py-3 border-b border-slate-700">
          <div class="text-sm tracking-wider text-slate-300 font-semibold">Llamando:</div>
        </div>
        <div class="p-6 flex items-center justify-between h-full">
          <div>
            <div class="text-xs text-slate-400">TURNO</div>
            <div class="text-6xl sm:text-7xl md:text-8xl font-black leading-none tracking-widest">
              @if($actual)
                {{ ($actual->servicio?->codigo ?? '') . str_pad($actual->numero,3,'0',STR_PAD_LEFT) }}
              @else
                —
              @endif
            </div>
          </div>
          <div class="text-right">
            <div class="text-xs text-slate-400">MÓDULO</div>
            <div class="text-6xl sm:text-7xl md:text-8xl font-black">
              @if($actual)
                {{ $actual->puesto_id ?? '—' }}
              @else
                —
              @endif
            </div>
          </div>
        </div>
      </div>

      {{-- Imagen / placeholder --}}
      <div class="row-span-3 rounded-2xl border border-slate-700 overflow-hidden">
        <div class="h-full bg-cover bg-center"
             style="background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1200&auto=format&fit=crop');">
          <div class="bg-black/40 h-full w-full flex items-center justify-center">
            <p class="text-slate-100 text-xl font-medium">
              Bienvenidos — “por favor espere su turno”
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>

  {{-- FOOTER / MARQUEE --}}
  <footer class="w-full bg-slate-800 border-t border-slate-700">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between text-sm text-slate-300">
      <div>© UTN-FSA — Mesa de Atención</div>
      <div class="overflow-hidden w-1/2">
        <div class="animate-[marquee_18s_linear_infinite] whitespace-nowrap">
          <span class="mr-12">Bienvenidos. Por favor espere su turno.</span>
          <span class="mr-12">Recordá tener tu DNI a mano.</span>
          <span class="mr-12">Gracias por su paciencia.</span>
        </div>
      </div>
    </div>
  </footer>

  {{-- audio DENTRO del mismo root (clave para Livewire) --}}
  <audio id="bell" src="/sounds/ding.mp3" preload="auto" class="hidden"></audio>

  {{-- animación marquee --}}
  <style>
    @keyframes marquee { 0% {transform: translateX(0)} 100% {transform: translateX(-100%)} }
  </style>
</div>

@push('scripts')
<script>
  // desbloqueo de audio por políticas de los navegadores
  document.addEventListener('click', () => {
    const a = document.getElementById('bell');
    if (a) a.muted = false;
  }, { once: true });

  if (window.Echo) {
    window.Echo.channel('pantalla')
      .listen('.turno.llamado', (e) => {
        // tocar sonido
        const a = document.getElementById('bell');
        a && a.play().catch(()=>{})

        // pedir a Livewire que re-renderice
        Livewire.dispatch('refresh-pantalla', e)
      })
  }
</script>
@endpush
