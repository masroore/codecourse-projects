<?php

require_once __DIR__ . '/../bootstrap/app.php';

$indexer = $container->get('tnt')->createIndex('articles.index');
$indexer->query('SELECT id, title, body FROM articles;');
$indexer->run();
