<?php

namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $messeges;

    public function __construct($messeges)
    {
        $this->messeges =$messeges;
    }

   public function broadcastOn()
        {
            return new PrivateChannel('messege.' . $this->messeges->conversation_id);
        }


    public function broadcastWith()
    {
        return [
            'message' => $this->messeges->message,
            'sender_id' => $this->messeges->sender_id,
            'receiver_id' => $this->messeges->receiver_id,
            'conversation_id' => $this->messeges->conversation_id,
            'created_at' => $this->messeges->created_at->format('d-m-Y H:i:s'),
        ];
    }
}
