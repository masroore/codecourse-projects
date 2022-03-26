<?php

use App\Controllers\PodcastController;

$app->get('/podcasts', PodcastController::class . ':index');
$app->get('/podcasts/{id}', PodcastController::class . ':show');
