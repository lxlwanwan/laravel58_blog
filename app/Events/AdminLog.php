<?php

namespace App\Events;

use App\Model\Admin\AdminUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AdminLog
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $admin;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(AdminUser $admin)
    {
        //
        $this->admin=$admin;
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
