<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../');
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {

}

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/pagination.php';

$app = new Silex\Application([
    'debug' => getenv('APP_DEBUG'),
]);

$app->after(new \App\Middleware\Cors());

$app->register(new \Silex\Provider\ServiceControllerServiceProvider());

$app['fractal'] = function () {
    return new \League\Fractal\Manager();
};

$app['podcast.controller'] = function ($app) {
    return new \App\Controllers\PodcastController($app['fractal']);
};

require_once __DIR__ . '/../routes/api.php';
