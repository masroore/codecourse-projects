<?php

return [

    'url' => 'http://localhost',

    'db' => [

        'mysql' => [
            'host' => '127.0.0.1',
            'dbname' => 'destructy',
            'username' => 'root',
            'password' => 'root',
        ],

    ],

    'services' => [

        'mailgun' => [
            'domain' => 'YOUR_MAILGUN_DOMAIN',
            'secret' => 'YOUR_MAILGUN_KEY',
        ],

    ],

];
