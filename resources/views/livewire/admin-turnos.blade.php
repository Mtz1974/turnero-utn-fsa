<div class="p-6" wire:poll.3000ms>
  <h1 class="text-2xl font-bold mb-4">Panel de Turnos</h1>

  <div class="flex flex-wrap gap-3 items-end mb-4">
    <div>
      <label class="text-sm font-semibold">Estado</label>
      <select wire:model.live="estado" class="border rounded px-3 py-2">
        <option value="todos">Todos</option>
        <option value="en_espera">En espera</option>
        <option value="llamado">Llamado</option>
        <option value="atendiendo">Atendiendo</option>
        <option value="atendido">Atendido</option>
        <option value="ausente">Ausente</option>
      </select>
    </div>

    <div>
      <label class="text-sm font-semibold">Servicio</label>
      <select wire:model.live="servicioId" class="border rounded px-3 py-2">
        <option value="">Todos</option>
        @foreach($servicios as $s)
          <option value="{{ $s->id }}">{{ $s->nombre }} ({{ $s->codigo }})</option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="text-sm font-semibold">Buscar</label>
      <input type="text" wire:model.debounce.400ms="q" class="border rounded px-3 py-2" placeholder="EM-004, AFI, 12…">
    </div>
  </div>

  <div class="bg-white rounded-xl shadow divide-y">
    @forelse($tickets as $t)
      <div class="p-3 flex items-center justify-between">
        <div class="font-semibold">
          {{ $t->servicio->codigo }}{{ str_pad($t->numero,3,'0',STR_PAD_LEFT) }}
          @if($t->prioritario)<span class="text-amber-600">• Prioritario</span>@endif
        </div>
        <div class="text-sm text-gray-600">Estado: <span class="font-medium">{{ $t->estado }}</span></div>
        <div class="text-xs text-gray-500">{{ $t->created_at->format('d/m H:i') }}</div>
      </div>
    @empty
      <div class="p-4 text-gray-500">Sin resultados…</div>
    @endforelse
  </div>

  <div class="mt-3">{{ $tickets->links() }}</div>
</div>
