<?php

namespace App\Enums;

enum WeatherUnits: string
{
    case STANDARD = 'standard';
    case METRIC = 'metric';
    case IMPERIAL = 'imperial';
}
