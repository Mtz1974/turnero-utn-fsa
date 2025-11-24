<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Ticket;
use App\Models\Puesto;
use Illuminate\Support\Carbon;
use App\Events\TurnoLlamado; // 👈 IMPORTANTE: evento de broadcast

#[Layout('layouts.app')]
class PuestoPanel extends Component
{
    /** Turno que el agente está trabajando ahora (o el último llamado) */
    public ?Ticket $ticketActual = null;

    /** Cola completa de turnos en espera */
    public $cola = [];

    /** Lista de módulos disponibles (1..5) */
    public $puestos = [];

    public function mount(): void
    {
        // Podés traerlos de la tabla puestos, o generar 1..5
        $this->puestos = Puesto::orderBy('id')->get();

        $this->refrescarDatos();
    }

    /** Refresca turno actual + cola de espera */
    public function refrescarDatos(): void
    {
        $this->ticketActual = Ticket::with(['servicio', 'puesto'])
            ->whereIn('estado', ['llamado', 'atendiendo'])
            ->latest('llamado_at')
            ->first();

        $this->cola = Ticket::with('servicio')
            ->where('estado', 'en_espera')
            ->orderByDesc('prioritario')
            ->orderBy('id')
            ->get();
    }

    /**
     * Asigna un módulo a un ticket en espera y lo marca como LLAMADO.
     */
    public function asignarYllamar(int $ticketId, int $puestoId): void
    {
        $ticket = Ticket::find($ticketId);

        if (!$ticket || $ticket->estado !== 'en_espera') {
            return;
        }

        $ticket->estado     = 'llamado';
        $ticket->puesto_id  = $puestoId;
        $ticket->llamado_at = Carbon::now();
        $ticket->save();

        // Cargar relaciones para el payload del evento
        $ticket->loadMissing(['servicio', 'puesto']);

        $this->ticketActual = $ticket;

        // Refrescar cola en pantalla
        $this->refrescarDatos();

        // Notificar a Livewire (como ya lo hacías)
        $this->dispatch('turno-llamado', id: $ticket->id);

        // 🔊🌐 Notificar por WebSocket (Laravel Reverb + Echo)
        $codigo = ($ticket->servicio?->codigo ?? '') . str_pad($ticket->numero, 3, '0', STR_PAD_LEFT);

        event(new TurnoLlamado([
            'id'         => $ticket->id,
            'codigo'     => $codigo,
            'estado'     => $ticket->estado,
            'puesto'     => $ticket->puesto?->id,
            'puesto_nombre' => $ticket->puesto?->nombre,
            'prioritario'=> (bool)$ticket->prioritario,
            'llamado_at' => $ticket->llamado_at?->toIso8601String(),
        ]));
    }

    public function comenzar(): void
    {
        if (!$this->ticketActual) {
            return;
        }

        $this->ticketActual->estado = 'atendiendo';
        $this->ticketActual->save();

        $this->dispatch('turno-en-atencion', id: $this->ticketActual->id);

        $this->refrescarDatos();
    }

    public function rellamar(): void
    {
        if (!$this->ticketActual) {
            return;
        }

        $this->ticketActual->llamado_at = Carbon::now();
        $this->ticketActual->save();

        // Livewire browser event
        $this->dispatch('turno-llamado', id: $this->ticketActual->id);

        // También rebroadcast para que la pantalla “escuche” y suene el ding de nuevo
        $this->ticketActual->loadMissing(['servicio', 'puesto']);

        $codigo = ($this->ticketActual->servicio?->codigo ?? '') .
            str_pad($this->ticketActual->numero, 3, '0', STR_PAD_LEFT);

        event(new TurnoLlamado([
            'id'         => $this->ticketActual->id,
            'codigo'     => $codigo,
            'estado'     => $this->ticketActual->estado,
            'puesto'     => $this->ticketActual->puesto?->id,
            'puesto_nombre' => $this->ticketActual->puesto?->nombre,
            'prioritario'=> (bool)$this->ticketActual->prioritario,
            'llamado_at' => $this->ticketActual->llamado_at?->toIso8601String(),
        ]));
    }

    public function cerrar(): void
    {
        if (!$this->ticketActual) {
            return;
        }

        $this->ticketActual->estado = 'atendido';
        $this->ticketActual->save();

        $this->dispatch('turno-cerrado', id: $this->ticketActual->id);
        $this->ticketActual = null;

        $this->refrescarDatos();
    }

    public function ausente(): void
    {
        if (!$this->ticketActual) {
            return;
        }

        $this->ticketActual->estado = 'ausente';
        $this->ticketActual->save();

        $this->dispatch('turno-ausente', id: $this->ticketActual->id);
        $this->ticketActual = null;

        $this->refrescarDatos();
    }

    public function render()
    {
        return view('livewire.puesto-panel');
    }
}
