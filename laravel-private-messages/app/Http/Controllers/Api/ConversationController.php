<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use App\Events\ConversationCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConversationRequest;
use App\Transformers\ConversationTransformer;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $conversations = $request->user()->conversations()->get();

        return fractal()
            ->collection($conversations)
            ->parseIncludes(['user', 'users'])
            ->transformWith(new ConversationTransformer())
            ->toArray();
    }

    public function show(Conversation $conversation)
    {
        $this->authorize('show', $conversation);

        if ($conversation->isReply()) {
            abort(404);
        }

        return fractal()
            ->item($conversation)
            ->parseIncludes(['user', 'users', 'replies', 'replies.user'])
            ->transformWith(new ConversationTransformer())
            ->toArray();
    }

    public function store(StoreConversationRequest $request)
    {
        $conversation = new Conversation();
        $conversation->body = $request->body;
        $conversation->user()->associate($request->user());
        $conversation->save();

        $conversation->touchLastReply();

        $conversation->users()->sync(array_unique(
            array_merge($request->recipients, [$request->user()->id])
        ));

        $conversation->load('users');

        broadcast(new ConversationCreated($conversation))->toOthers();

        return fractal()
            ->item($conversation)
            ->parseIncludes(['user', 'users', 'replies', 'replies.user'])
            ->transformWith(new ConversationTransformer())
            ->toArray();
    }
}
