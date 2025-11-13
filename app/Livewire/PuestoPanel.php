<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Ticket;
use Illuminate\Support\Carbon;
use App\Events\TurnoLlamado;   // 👈 nuevo: evento para websockets

#[Layout('layouts.app')] // usamos el layout con navbar para usuarios logueados
class PuestoPanel extends Component
{
    public ?Ticket $ticket = null;

    public function mount(): void
    {
        // Si hay algún ticket "llamado" o "atendiendo" recientemente, lo mostramos (opcional)
        $this->ticket = Ticket::whereIn('estado', ['llamado', 'atendiendo'])
            ->latest('llamado_at')
            ->first();
    }

    public function llamarSiguiente(): void
    {
        // Próximo en espera: primero prioritarios, luego por id
        $sig = Ticket::where('estado', 'en_espera')
            ->orderByDesc('prioritario')
            ->orderBy('id')
            ->first();

        if (!$sig) {
            $this->ticket = null;
            $this->dispatch('toast', ['type' => 'info', 'msg' => 'No hay turnos en espera.']);
            return;
        }

        $sig->estado = 'llamado';
        $sig->llamado_at = Carbon::now();
        $sig->save();

        $this->ticket = $sig;

        // 🔔 Broadcast para /pantalla (Echo): reproducir sonido y refrescar
        event(new TurnoLlamado([
            'id'     => $sig->id,
            'codigo' => ($sig->servicio?->codigo ?? '') . str_pad($sig->numero, 3, '0', STR_PAD_LEFT),
            'serv'   => $sig->servicio?->codigo,
            'modulo' => $sig->puesto_id ?? null,  // ajustá si usás otro campo para el “módulo/agente”
            'prio'   => (bool) $sig->prioritario,
            'at'     => $sig->llamado_at?->toISOString(),
        ]));

        // Notificar también dentro del propio Livewire (si lo usás)
        $this->dispatch('turno-llamado', id: $sig->id);
    }

    public function comenzar(): void
    {
        if (!$this->ticket) return;

        $this->ticket->estado = 'atendiendo';
        $this->ticket->save();

        $this->dispatch('turno-en-atencion', id: $this->ticket->id);
    }

    public function rellamar(): void
    {
        if (!$this->ticket) return;

        $this->ticket->llamado_at = Carbon::now();
        $this->ticket->save();

        // 🔔 Broadcast otra vez (re-llamado)
        event(new TurnoLlamado([
            'id'     => $this->ticket->id,
            'codigo' => ($this->ticket->servicio?->codigo ?? '') . str_pad($this->ticket->numero, 3, '0', STR_PAD_LEFT),
            'serv'   => $this->ticket->servicio?->codigo,
            'modulo' => $this->ticket->puesto_id ?? null,
            'prio'   => (bool) $this->ticket->prioritario,
            'at'     => $this->ticket->llamado_at?->toISOString(),
        ]));

        $this->dispatch('turno-llamado', id: $this->ticket->id);
    }

    public function cerrar(): void
    {
        if (!$this->ticket) return;

        $this->ticket->estado = 'atendido';
        $this->ticket->save();

        $this->dispatch('turno-cerrado', id: $this->ticket->id);
        $this->ticket = null;
    }

    public function ausente(): void
    {
        if (!$this->ticket) return;

        $this->ticket->estado = 'ausente';
        $this->ticket->save();

        $this->dispatch('turno-ausente', id: $this->ticket->id);
        $this->ticket = null;
    }

    public function render()
    {
        return view('livewire.puesto-panel');
    }
}
