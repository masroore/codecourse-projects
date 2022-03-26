<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application([
    'debug' => true,
]);

require_once __DIR__ . '/../routes/api.php';
