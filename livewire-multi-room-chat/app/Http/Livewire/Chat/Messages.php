<?php

namespace App\Http\Livewire\Chat;

use App\Message;
use App\Room;
use Livewire\Component;

class Messages extends Component
{
    /**
     * Undocumented variable.
     *
     * @var [type]
     */
    public $roomId;

    /**
     * Undocumented variable.
     *
     * @var [type]
     */
    public $messages;

    /**
     * Undocumented function.
     *
     * @param [type] $messages
     *
     * @return void
     */
    public function mount(Room $room, $messages)
    {
        $this->roomId = $room->id;
        $this->messages = $messages;
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function getListeners()
    {
        return [
            'message.added' => 'prependMessage',
            "echo-private:chat.{$this->roomId},Chat\\MessageAdded" => 'prependMessageFromBroadcast',
        ];
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function prependMessage($id)
    {
        $this->messages->prepend(Message::find($id));
    }

    /**
     * Undocumented function.
     *
     * @param [type] $payload
     *
     * @return void
     */
    public function prependMessageFromBroadcast($payload)
    {
        $this->prependMessage($payload['message']['id']);
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.chat.messages');
    }
}
