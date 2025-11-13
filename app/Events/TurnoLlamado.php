<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TurnoLlamado implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    // Canal público “pantalla”
    public function broadcastOn(): array
    {
        return [ new Channel('pantalla') ];
    }

    // Nombre del evento en el cliente
    public function broadcastAs(): string
    {
        return 'turno.llamado';
    }
}
