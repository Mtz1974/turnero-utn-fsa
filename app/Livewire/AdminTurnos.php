<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\{Ticket, Servicio};

#[Layout('layouts.app')]
class AdminTurnos extends Component
{
    use WithPagination;

    public string $estado = 'todos';
    public ?int $servicioId = null;
    public string $q = '';

    protected $updatesQueryString = ['estado','servicioId','q','page'];

    public function updating($field)
    {
        if (in_array($field, ['estado','servicioId','q'])) $this->resetPage();
    }

    public function render()
    {
        $servicios = Servicio::orderBy('nombre')->get();

        $query = Ticket::with('servicio')->latest('id');
        if ($this->estado !== 'todos') $query->where('estado', $this->estado);
        if ($this->servicioId)       $query->where('servicio_id', $this->servicioId);
        if (trim($this->q) !== '') {
            $q = trim($this->q);
            $query->where(function ($w) use ($q) {
                $w->where('numero','like',"%$q%")
                  ->orWhereHas('servicio', fn($s)=>$s->where('codigo','like',"%$q%")->orWhere('nombre','like',"%$q%"));
            });
        }

        $tickets = $query->paginate(12);

        return view('livewire.admin-turnos', compact('tickets','servicios'));
    }
}
