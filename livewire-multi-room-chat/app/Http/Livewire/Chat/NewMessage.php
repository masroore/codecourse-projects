<?php

namespace App\Http\Livewire\Chat;

use App\Events\Chat\MessageAdded;
use App\Room;
use Livewire\Component;

class NewMessage extends Component
{
    /**
     * Undocumented variable.
     *
     * @var [type]
     */
    public $room;

    /**
     * Undocumented variable.
     *
     * @var string
     */
    public $body = '';

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function mount(Room $room)
    {
        $this->room = $room;
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function send()
    {
        $message = $this->room->messages()->create([
            'body' => $this->body,
            'user_id' => auth()->user()->id,
        ]);

        $this->emit('message.added', $message->id);

        broadcast(new MessageAdded($this->room, $message))->toOthers();

        $this->body = '';
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.chat.new-message');
    }
}
