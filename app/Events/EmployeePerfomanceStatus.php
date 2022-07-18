<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Employee;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class EmployeePerfomanceStatus implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $id;
	public $slug;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$id,$slug)
    {
        $this->message = $message;
        $this->id = $id;
        $this->slug = $slug;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['employee-perfomance-status'];
    }
    public function broadcastAs()
    {
        return 'empperfomancestatus';
    }
}
