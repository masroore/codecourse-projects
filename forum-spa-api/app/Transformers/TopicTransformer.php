<?php

namespace App\Transformers;

use App\Models\Topic;
use League\Fractal\TransformerAbstract;

class TopicTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'user',
        'section',
        'posts',
    ];

    public function transform(Topic $topic)
    {
        return [
            'id' => $topic->id,
            'title' => $topic->title,
            'slug' => $topic->slug,
            'body' => $topic->body,
            'diffForHumans' => $topic->created_at->diffForHumans(),
        ];
    }

    public function includeUser(Topic $topic)
    {
        return $this->item($topic->user, new UserTransformer());
    }

    public function includeSection(Topic $topic)
    {
        return $this->item($topic->section, new SectionTransformer());
    }

    public function includePosts(Topic $topic)
    {
        return $this->collection($topic->posts, new PostTransformer());
    }
}
