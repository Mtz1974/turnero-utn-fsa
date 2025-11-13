<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Ticket;
use Livewire\Attributes\On;

#[Layout('layouts.blank')] // o el que estés usando para pantalla
class PantallaTV extends Component
{
    #[On('refresh-pantalla')]
public function refreshFromWs() {}
    public function render()
    {
        // Últimos llamados/atendiendo (los más recientes primero)
        $llamados = Ticket::with('servicio')
            ->whereIn('estado', ['llamado', 'atendiendo'])
            ->latest('llamado_at')
            ->take(6)
            ->get();

        // El actual es el último llamado
        $actual = $llamados->first();

        // Cola visible (opcional): próximos en espera
        $cola = Ticket::with('servicio')
            ->where('estado', 'en_espera')
            ->orderByDesc('prioritario')
            ->orderBy('id')
            ->take(12)
            ->get();

        return view('livewire.pantalla-tv', compact('llamados', 'actual', 'cola'));
    }
}

