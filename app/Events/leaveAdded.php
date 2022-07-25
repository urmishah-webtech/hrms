<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Employee;
class leaveAdded implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $id;
    public $admin_ids;
	public $assi_manager_ids;
    public $slug;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$id,$admin_ids,$assi_manager_ids,$slug)
    {
        $this->message = $message;
        $this->id = $id;
        $this->admin_ids=$admin_ids;
        $this->assi_manager_ids=$assi_manager_ids;
        $this->slug=$slug;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['leave-added'];
    }

    public function broadcastAs()
    {
        return 'leaveadded';
    }
}
