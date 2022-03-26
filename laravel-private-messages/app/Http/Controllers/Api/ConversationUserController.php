<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use App\Events\ConversationUsersCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConversationUserRequest;
use App\Transformers\ConversationTransformer;

class ConversationUserController extends Controller
{
    public function store(StoreConversationUserRequest $request, Conversation $conversation)
    {
        $this->authorize('affect', $conversation);

        $conversation->users()->syncWithoutDetaching($request->recipients);

        $conversation->load(['users']);

        broadcast(new ConversationUsersCreated($conversation))->toOthers();

        return fractal()
            ->item($conversation)
            ->parseIncludes(['user', 'users'])
            ->transformWith(new ConversationTransformer())
            ->toArray();
    }
}
