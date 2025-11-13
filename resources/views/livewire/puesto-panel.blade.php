<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Panel del Puesto</h1>

    @if ($ticket)
        <div class="rounded-lg border p-4 mb-4">
            <div class="text-lg">
                <span class="font-semibold">Ticket:</span>
                <span class="px-2 py-1 rounded bg-slate-800 text-white">
                    {{ $ticket->codigo_completo ?? ($ticket->servicio->codigo . str_pad($ticket->numero, 3, '0', STR_PAD_LEFT)) }}
                </span>

                @if($ticket->prioritario)
                    <span class="ml-2 text-sm px-2 py-1 rounded bg-amber-500 text-white">Prioritario</span>
                @endif
            </div>
            <div class="text-sm mt-1">
                <span class="font-semibold">Estado:</span> {{ ucfirst($ticket->estado) }}
            </div>
        </div>

        <div class="flex flex-wrap gap-2">
            <button wire:click="comenzar" class="px-4 py-2 rounded bg-blue-600 text-white">Comenzar</button>
            <button wire:click="rellamar" class="px-4 py-2 rounded bg-indigo-600 text-white">Re-llamar</button>
            <button wire:click="cerrar" class="px-4 py-2 rounded bg-emerald-600 text-white">Cerrar (Atendido)</button>
            <button wire:click="ausente" class="px-4 py-2 rounded bg-rose-600 text-white">Ausente</button>
        </div>
    @else
        <div class="rounded-lg border p-6 mb-4 text-slate-600">
            No hay ticket seleccionado.
        </div>
        <button wire:click="llamarSiguiente" class="px-4 py-2 rounded bg-blue-600 text-white">
            Llamar siguiente
        </button>
    @endif
</div>
