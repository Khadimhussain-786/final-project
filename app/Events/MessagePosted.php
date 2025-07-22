<?php

namespace App\Events;

use App\Models\Advert;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessagePosted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $advert_id;
    
    public $user;

    public $chat;

    /**
     * Create a new event instance.
     */
    public function __construct(Chat $chat,User $user,Advert $advert_id)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chatroom',$this->user->id.$this->advert_id),
        ];
    }
}
