<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Intake;
use App\User;

class IntakeAvailableEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $intake;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Intake $intake, User $user)
    {
        $this->intake = $intake;
        $this->user = $user;
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
