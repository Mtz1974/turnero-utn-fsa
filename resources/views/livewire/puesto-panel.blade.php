<div class="max-w-6xl mx-auto p-6 space-y-6">

    {{-- PANEL DEL TURNO ACTUAL --}}
    <div class="bg-slate-900/40 border border-slate-700 rounded-xl p-4 space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold">Panel del Puesto</h1>
            @if($ticketActual)
                <span class="text-sm text-slate-400">
                    Turno actual en
                    <span class="font-semibold">
                        Módulo {{ $ticketActual->puesto?->id ?? '—' }}
                    </span>
                </span>
            @endif
        </div>

        @if($ticketActual)
            @php
                $codigoActual = ($ticketActual->servicio?->codigo ?? '') .
                    str_pad($ticketActual->numero, 3, '0', STR_PAD_LEFT);
            @endphp

            <div class="rounded-lg border border-slate-700 p-4 mb-4 bg-slate-900/60">
                <div class="text-lg flex items-center gap-2">
                    <span class="font-semibold">Ticket:</span>
                    <span class="px-2 py-1 rounded bg-slate-800 text-white">
                        {{ $codigoActual }}
                    </span>

                    @if($ticketActual->prioritario)
                        <span class="ml-2 text-xs px-2 py-1 rounded-full bg-amber-500 text-black font-bold">
                            Prioritario
                        </span>
                    @endif
                </div>
                <div class="text-sm mt-1 text-slate-300">
                    <span class="font-semibold">Estado:</span> {{ ucfirst($ticketActual->estado) }}
                </div>
                <div class="text-sm mt-1 text-slate-300">
                    <span class="font-semibold">Módulo:</span>
                    {{ $ticketActual->puesto?->id ?? '—' }}
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <button
                    wire:click="comenzar"
                    class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white text-sm"
                >
                    Comenzar
                </button>

                <button
                    wire:click="rellamar"
                    class="px-4 py-2 rounded bg-indigo-600 hover:bg-indigo-700 text-white text-sm"
                >
                    Re-llamar
                </button>

                <button
                    wire:click="cerrar"
                    class="px-4 py-2 rounded bg-emerald-600 hover:bg-emerald-700 text-white text-sm"
                >
                    Cerrar (Atendido)
                </button>

                <button
                    wire:click="ausente"
                    class="px-4 py-2 rounded bg-rose-600 hover:bg-rose-700 text-white text-sm"
                >
                    Ausente
                </button>
            </div>
        @else
            <div class="rounded-lg border border-dashed border-slate-700 p-6 text-slate-400 text-sm">
                No hay turno seleccionado. Elegí uno de la lista de abajo y asignale un módulo.
            </div>
        @endif
    </div>

    {{-- LISTA DE TODOS LOS TURNOS EN ESPERA --}}
    <div class="bg-slate-900/40 border border-slate-700 rounded-xl overflow-hidden">
        <div class="px-4 py-3 border-b border-slate-700 flex items-center justify-between">
            <h2 class="font-semibold text-slate-100">Turnos en espera</h2>
            <span class="text-xs text-slate-400">
                Seleccioná un módulo para llamar un turno
            </span>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-slate-800 text-slate-300 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-2 text-left">Turno</th>
                    <th class="px-4 py-2 text-left">Prioridad</th>
                    <th class="px-4 py-2 text-left">Estado</th>
                    <th class="px-4 py-2 text-left">Asignar módulo</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($cola as $t)
                    @php
                        $codigo = ($t->servicio?->codigo ?? '') .
                            str_pad($t->numero, 3, '0', STR_PAD_LEFT);
                    @endphp
                    <tr wire:key="ticket-{{ $t->id }}">
                        <td class="px-4 py-2 font-semibold">
                            {{ $codigo }}
                        </td>
                        <td class="px-4 py-2">
                            @if($t->prioritario)
                                <span class="px-2 py-0.5 rounded-full bg-amber-500 text-xs font-bold text-black">
                                    Prioritario
                                </span>
                            @else
                                <span class="text-xs text-slate-400">Normal</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <span class="text-xs px-2 py-1 rounded bg-slate-800 text-slate-200">
                                {{ ucfirst($t->estado) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <select
                                class="text-sm rounded-md border-slate-700 bg-slate-900 text-slate-100"
                                wire:change="asignarYllamar({{ $t->id }}, $event.target.value)"
                            >
                                <option value="">Seleccionar módulo…</option>
                                @foreach($puestos as $p)
                                    <option value="{{ $p->id }}">
                                        Módulo {{ $p->id }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-sm text-slate-400">
                            No hay turnos en espera.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
