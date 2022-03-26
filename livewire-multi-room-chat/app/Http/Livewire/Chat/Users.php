<?php

namespace App\Http\Livewire\Chat;

use App\Room;
use Livewire\Component;

class Users extends Component
{
    public $roomId;

    public $users;

    public function mount(Room $room)
    {
        $this->roomId = $room->id;
    }

    public function getListeners()
    {
        return [
            "echo-presence:chat.{$this->roomId},here" => 'setUsersHere',
            "echo-presence:chat.{$this->roomId},joining" => 'setUserJoining',
            "echo-presence:chat.{$this->roomId},leaving" => 'setUserLeaving',
        ];
    }

    public function setUsersHere($users)
    {
        $this->users = $users;
    }

    public function setUserJoining($user)
    {
        $this->users[] = $user;
    }

    public function setUserLeaving($user)
    {
        $this->users = array_filter($this->users, function ($u) use ($user) {
            return $u['id'] != $user['id'];
        });
    }

    public function render()
    {
        return view('livewire.chat.users');
    }
}
