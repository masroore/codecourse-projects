<?php

$app->get('/', 'HomeController@index');
$app->get('/{code}', 'LinkController@get');
