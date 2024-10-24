<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherByCityRequest;
use App\Services\WeatherClient;
use App\Services\WeatherDtoFactory;
use App\Services\WeatherRequestParams;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class WeatherController extends Controller
{
    public function __construct(
        protected WeatherClient     $weatherClient,
        protected WeatherDtoFactory $weatherDtoFactory
    )
    {
    }

    /**
     * @param WeatherByCityRequest $request
     * @return JsonResponse
     */
    public function getCurrentWeatherByCity(WeatherByCityRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $weatherData = $this->weatherClient->getCurrentWeatherByCity(
                new WeatherRequestParams(
                    city: $validatedData['city'],
                    stateCode: Arr::get($validatedData, 'state_code'),
                    countryCode: Arr::get($validatedData, 'country_code'),
                    mode: Arr::get($validatedData, 'mode'),
                    units: Arr::get($validatedData, 'units'),
                    lang: Arr::get($validatedData, 'lang')
                )
            );
            $weatherDto = $this->weatherDtoFactory->createCurrentWeather($weatherData);
            return response()->json($weatherDto, options: JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $exception) {
            return response()->json([
                'message' => 'Something went wrong',
            ], 500);
        }
    }
}
