<?php

namespace App\Services;

use App\Models\{Ticket, Servicio, Puesto, Llamado};
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TurneroService
{
    public function nuevoTicket(Servicio $servicio, bool $prioritario=false): Ticket {
        return DB::transaction(function() use($servicio,$prioritario){
            $hoy = now()->toDateString();
            $ultimo = Ticket::where('servicio_id',$servicio->id)
                ->whereDate('created_at',$hoy)->max('numero');

            return Ticket::create([
                'servicio_id'=>$servicio->id,
                'numero'=>($ultimo ?? 0)+1,
                'prioritario'=>$prioritario,
            ]);
        });
    }

    public function siguiente(Puesto $puesto): ?Ticket {
        return DB::transaction(function() use($puesto){
            $q = Ticket::where('estado','en_espera');
            if($puesto->servicio_id){ $q->where('servicio_id',$puesto->servicio_id); }

            $t = $q->orderByDesc('prioritario')->orderBy('id')->lockForUpdate()->first();
            if(!$t) return null;

            $t->update(['estado'=>'llamado','llamado_at'=>now()]);
            Llamado::create(['ticket_id'=>$t->id,'puesto_id'=>$puesto->id,'tipo'=>'llamar']);
            return $t;
        });
    }

    public function comenzarAtencion(Ticket $t): Ticket {
        if($t->estado!=='llamado') throw ValidationException::withMessages(['ticket'=>'No está llamado.']);
        $t->update(['estado'=>'atendiendo']);
        return $t;
    }

    public function cerrarAtendido(Ticket $t, Puesto $p): Ticket {
        if(!in_array($t->estado,['llamado','atendiendo'])) throw ValidationException::withMessages(['ticket'=>'No se puede cerrar.']);
        $t->update(['estado'=>'atendido','atendido_at'=>now()]);
        Llamado::create(['ticket_id'=>$t->id,'puesto_id'=>$p->id,'tipo'=>'cerrar_atendido']);
        return $t;
    }

    public function marcarAusente(Ticket $t, Puesto $p): Ticket {
        if($t->estado!=='llamado') throw ValidationException::withMessages(['ticket'=>'Sólo si fue llamado.']);
        $t->update(['estado'=>'ausente']);
        Llamado::create(['ticket_id'=>$t->id,'puesto_id'=>$p->id,'tipo'=>'cerrar_ausente']);
        return $t;
    }

    public function rellamar(Ticket $t, Puesto $p, int $limite=3): Ticket {
        if(!in_array($t->estado,['llamado','atendiendo'])) throw ValidationException::withMessages(['ticket'=>'Estado no válido.']);
        if($t->reintentos >= $limite) throw ValidationException::withMessages(['ticket'=>'Límite de re-llamado.']);
        $t->increment('reintentos');
        Llamado::create(['ticket_id'=>$t->id,'puesto_id'=>$p->id,'tipo'=>'rellamar']);
        return $t->refresh();
    }
}
