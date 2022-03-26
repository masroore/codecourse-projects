<?php

$app->get('/podcasts', 'PodcastController@index');
$app->get('/podcasts/{id}', 'PodcastController@show');
