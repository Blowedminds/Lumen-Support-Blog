<?php

namespace App\Events;

use App\Modules\Core\RoomMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageCreatedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $room_message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RoomMessage $room_message)
    {
        $this->room_message = $room_message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel( 'article.' . $this->room_message->room->article->slug);
    }

    public function broadcastAs()
    {
        return 'message.created';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->room_message->id,
            'message' => $this->room_message->message,
            'slug' => $this->room_message->room->article->slug,
            'user_id' => $this->room_message->user->user_id,
            'created_at' => $this->room_message->created_at->toDateTimeString(),
            'user' => [
                'name' => $this->room_message->user->name,
                'user_id' => $this->room_message->user->user_id
            ]
        ];
    }
}
