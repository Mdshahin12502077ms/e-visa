<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message;
    public $title;
    public $user;
    public function __construct($message, $title, $user)
    {
         $this->title = $title;
        $this->message = $message;
        $this->user = $user;
    }



    public function broadcastOn()
    {
        return new PrivateChannel('notification'.$this->user);

    }

    public function broadcastWith(){
        
        return [
            'title' => $this->title,
            'message' => $this->message,

        ];
    }
}
