<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Ticket;
use App\Models\Puesto;
use Illuminate\Support\Carbon;

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
        $this->ticketActual = Ticket::whereIn('estado', ['llamado', 'atendiendo'])
            ->latest('llamado_at')
            ->first();

        $this->cola = Ticket::where('estado', 'en_espera')
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

        $this->ticketActual = $ticket;

        // Refrescar cola en pantalla
        $this->refrescarDatos();

        // Notificar a /pantalla
        $this->dispatch('turno-llamado', id: $ticket->id);
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

        $this->dispatch('turno-llamado', id: $this->ticketActual->id);
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
