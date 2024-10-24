<?php

namespace App\Enums;

enum WeatherMode: string
{
    case JSON = 'json';
    case XML = 'xml';
    case HTML = 'html';
}
