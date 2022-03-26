<?php

namespace App\Controllers;

use App\Models\Podcast;
use App\Transformers\PodcastTransformer;
use League\Fractal\Manager as Fractal;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PodcastController
{
    protected $fractal;

    public function __construct(Fractal $fractal)
    {
        $this->fractal = $fractal;
    }

    public function index()
    {
        $podcasts = Podcast::latest()->paginate(2);

        $transformer = (new Collection($podcasts->getCollection(), new PodcastTransformer()))
            ->setPaginator(new IlluminatePaginatorAdapter($podcasts));

        return new JsonResponse($this->fractal->createData($transformer)->toArray());
    }

    public function show($id)
    {
        $podcast = Podcast::find($id);

        if (null === $podcast) {
            return new Response(null, 404);
        }

        $transformer = new Item($podcast, new PodcastTransformer());

        return new JsonResponse($this->fractal->createData($transformer)->toArray());
    }
}
