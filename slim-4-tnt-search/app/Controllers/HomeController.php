<?php

namespace App\Controllers;

use App\Models\Article;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    /**
     * Render the home page.
     *
     * @param [type] $args
     *
     * @return void
     */
    public function index(Request $request, Response $response, $args)
    {
        ['q' => $q] = $request->getQueryParams() + ['q' => ''];

        $articles = $this->c->get('search')(Article::class)
            ->search($q)
            ->get();

        return $this->c->get('view')->render($response, 'home/index.twig', compact('articles'));
    }
}
