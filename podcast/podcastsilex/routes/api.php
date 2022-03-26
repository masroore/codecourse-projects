<?php

$app->get('/podcasts', 'podcast.controller:index');
$app->get('/podcasts/{id}', 'podcast.controller:show');
