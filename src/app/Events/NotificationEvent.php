<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userIds;
    public $notification;
    public $currentUser;
    /**
     * Create a new event instance.
     */
    public function __construct( $userIds, $notification, $currentUser)
    {
        $this->userIds = $userIds;
        $this->notification = $notification;
        $this->currentUser = $currentUser;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // create a private channel for each user
        $channels = [];
        foreach ($this->userIds as $userId) {
            $channels[] = new PrivateChannel('notification.' . $userId);
        }
        return $channels;


//        return $this->userIds->map(function ($userId) {
//             new PrivateChannel('notification.' . $userId);
//        } );
    }
}
