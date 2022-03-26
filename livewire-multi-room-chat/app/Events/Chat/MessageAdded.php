<?php

namespace App\Events\Chat;

use App\Message;
use App\Room;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageAdded implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * Undocumented variable.
     *
     * @var [type]
     */
    public $message;

    /**
     * Undocumented variable.
     *
     * @var [type]
     */
    protected $room;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Room $room, Message $message)
    {
        $this->room = $room;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array|\Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->room->id);
    }
}
