<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Servicio;
use App\Services\TurneroService;

#[Layout('layouts.blank')]
class KioscoTurnos extends Component
{
    public $servicios;
    public ?string $ticketGenerado = null;

    public function mount(): void
    {
        $this->servicios = Servicio::orderBy('nombre')->get();
    }

    public function generar(int $servicioId, bool $prioritario = false, TurneroService $svc): void
    {
        $servicio = Servicio::findOrFail($servicioId);
        $ticket   = $svc->nuevoTicket($servicio, $prioritario);

        $this->ticketGenerado = $servicio->codigo . str_pad($ticket->numero, 3, '0', STR_PAD_LEFT);
        $this->dispatch('turno-generado');
    }

    public function render()
    {
        return view('livewire.kiosco-turnos');
    }
}
