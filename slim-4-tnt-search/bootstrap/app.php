<?php

use App\Search\Builder;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\UriFactory;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use TeamTNT\TNTSearch\TNTSearch;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv(__DIR__ . '/../'))->load();
} catch (InvalidPathException $e) {

}

$container = new DI\Container();

AppFactory::setContainer($container);

$app = AppFactory::create();

$container->set('settings', function () {
    return [
        'app' => [
            'name' => getenv('APP_NAME'),
        ],
    ];
});

$container->set('view', function ($container) use ($app) {
    $twig = new Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);

    $twig->addExtension(
        new TwigExtension(
            $app->getRouteCollector()->getRouteParser(),
            (new UriFactory())->createFromGlobals($_SERVER),
            '/'
        )
    );

    return $twig;
});

$container->set('tnt', function () {
    $tnt = new TNTSearch();

    $tnt->loadConfig([
        'driver' => getenv('DB_DRIVER'),
        'host' => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'storage' => __DIR__ . '/../storage',
    ]);

    return $tnt;
});

$container->set('search', function ($container) {
    return function ($model) use ($container) {
        return new Builder($container->get('tnt'), $model);
    };
});

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../routes/web.php';
