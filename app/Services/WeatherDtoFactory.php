<?php

namespace App\Services;

use App\Dto\CurrentWeatherDto;
use Illuminate\Support\Arr;

class WeatherDtoFactory
{
    public function createCurrentWeather(array $weatherData): CurrentWeatherDto
    {
        $iconCode = $weatherData['weather'][0]['icon'];

        return new CurrentWeatherDto(
            city: $weatherData['name'],
            temperature: $weatherData['main']['temp'],
            weatherDescription: $weatherData['weather'][0]['description'],
            windSpeed: $weatherData['wind']['speed'],
            pressure: $weatherData['main']['pressure'],
            humidity: $weatherData['main']['humidity'],
            iconUrl: "https://openweathermap.org/img/wn/{$iconCode}@2x.png",
            rainProbability: Arr::get($weatherData, 'rain.1h'),
        );
    }
}
