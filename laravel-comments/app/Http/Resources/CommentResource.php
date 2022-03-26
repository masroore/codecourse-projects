<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'child' => null !== $this->parent_id,
            'parent_id' => $this->parent_id,
            'owner' => optional($request->user())->id === $this->user_id,
            'edited' => optional($this->edited_at)->diffForHumans(),
            'user' => new UserResource($this->user),
            'children' => self::collection($this->whenLoaded('children')),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
