<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\CreateTopicFormRequest;
use App\Http\Requests\Forum\GetTopicsFormRequest;
use App\Models\Section;
use App\Models\Topic;
use App\Transformers\TopicTransformer;

class TopicController extends Controller
{
    public function index(GetTopicsFormRequest $request, Section $section)
    {
        $topics = $section->find($request->get('section_id'))->topics()->latestFirst()->get();

        return fractal()
            ->collection($topics)
            ->includeUser()
            ->transformWith(new TopicTransformer())
            ->toArray();
    }

    public function show(Topic $topic)
    {
        return fractal()
            ->item($topic)
            ->includeUser()
            ->includePosts()
            ->transformWith(new TopicTransformer())
            ->toArray();
    }

    public function store(CreateTopicFormRequest $request)
    {
        $topic = $request->user()->topics()->create([
            'title' => $request->json('title'),
            'slug' => str_slug($request->json('title')),
            'body' => $request->json('body'),
            'section_id' => $request->json('section_id'),
        ]);

        return fractal()
            ->item($topic)
            ->includeUser()
            ->transformWith(new TopicTransformer())
            ->toArray();
    }
}
