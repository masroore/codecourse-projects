<?php

session_start();

require_once '../vendor/autoload.php';

$container = new \Slim\Container();

$container['config'] = function ($c) {
    return new \Noodlehaus\Config('../config/app.php');
};

$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages();
};

$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig('../resources/views');

    $view->addExtension(new \Slim\Views\TwigExtension(
        $c['router'],
        $c['config']->get('url')
    ));

    $view->getEnvironment()->addGlobal('flash', $c['flash']);

    return $view;
};

$container['db'] = function ($c) {
    return new PDO(
        'mysql:host=' . $c['config']->get('db.mysql.host') . ';dbname=' . $c['config']->get('db.mysql.dbname'),
        $c['config']->get('db.mysql.username'),
        $c['config']->get('db.mysql.password')
    );
};

$container['mail'] = function ($c) {
    return new \Mailgun\Mailgun($c['config']->get('services.mailgun.secret'));
};

$app = new \Slim\App($container);

require_once 'routes.php';
