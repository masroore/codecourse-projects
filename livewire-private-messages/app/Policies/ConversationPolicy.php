<?php

namespace App\Policies;

use App\Conversation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Conversation $conversation)
    {
        return $user->inConversation($conversation->id);
    }
}
