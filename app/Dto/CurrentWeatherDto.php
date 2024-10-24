<?php

namespace App\Dto;

class CurrentWeatherDto
{
    public function __construct(
        public string $city,
        public float $temperature,
        public string $weatherDescription,
        public float $windSpeed,
        public int $pressure,
        public int $humidity,
        public string $iconUrl,
        public ?float $rainProbability = null,
    )
    {
    }
}
