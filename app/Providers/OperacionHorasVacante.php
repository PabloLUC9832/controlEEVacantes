<?php

namespace App\Providers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OperacionHorasVacante
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $numPrograma;
    public $horasEE;
    public $tipoAsignacion;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($horasEE,$numPrograma,$tipoAsignacion)
    {
        //
        $this->numPrograma = $numPrograma;
        $this->horasEE = $horasEE;
        $this->tipoAsignacion = $tipoAsignacion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
