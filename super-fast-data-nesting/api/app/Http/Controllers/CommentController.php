<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'children.user'])
            ->latest()
            ->isParent()
            ->paginate(4);

        $children = Comment::with(['user'])
            ->whereIn('base_id', $comments->pluck('id')->toArray())
            ->get();

        return CommentResource::collection(
            $comments->merge($children)
        );
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}
