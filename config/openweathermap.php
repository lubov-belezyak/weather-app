<?php

return [

    'appid' => env('OPENWEATHERMAP_APPID'),
    'lang' => env('OPENWEATHERMAP_LANG', 'en'),

    'base_url' => 'https://api.openweathermap.org',
    'units' => 'metric',

    'api' => [
        'current_weather' => [
            'version' => '2.5',
            'endpoint' => 'weather'
        ],

        'one_call' => [
            'version' => '3.0',
            'endpoint' => 'onecall'
        ]
    ]
];
