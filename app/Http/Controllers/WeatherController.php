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
     * @OA\Get(
     *     path="/api/weather",
     *     summary="Получить текущую погоду по названию города",
     *     tags={"Weather"},
     *     @OA\Parameter(
     *         name="city",
     *         in="query",
     *         required=true,
     *         description="Название города",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="state_code",
     *         in="query",
     *         required=false,
     *         description="Код штата (если применимо). Максимум 2 символа.",
     *         @OA\Schema(type="string", maxLength=2)
     *     ),
     *     @OA\Parameter(
     *         name="country_code",
     *         in="query",
     *         required=false,
     *         description="Код страны (если применимо). Максимум 2 символа.",
     *         @OA\Schema(type="string", maxLength=2)
     *     ),
     *     @OA\Parameter(
     *         name="mode",
     *         in="query",
     *         required=false,
     *         description="Режим ответа (json, xml, html).",
     *         @OA\Schema(
     *             type="string",
     *             enum={"json", "xml", "html"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="units",
     *         in="query",
     *         required=false,
     *         description="Единицы измерения (standard, metric, imperial).",
     *         @OA\Schema(
     *             type="string",
     *             enum={"standard", "metric", "imperial"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="lang",
     *         in="query",
     *         required=false,
     *         description="Язык ответа. Максимум 5 символов.",
     *         @OA\Schema(type="string", maxLength=5)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ с погодными данными",
     *         @OA\JsonContent(
     *              example={
     *                  "city": "Екатеринбург",
     *                  "temperature": 6.77,
     *                  "weatherDescription": "небольшой проливной дождь",
     *                  "windSpeed": 0,
     *                  "pressure": 998,
     *                  "humidity": 100,
     *                  "iconUrl": "https://openweathermap.org/img/wn/09n@2x.png",
     *                  "rainProbability": null
     *              }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *            example={
     *                  "message": "The given data was invalid.",
     *                  "errors": {
     *                      "city": {
     *                          "Поле city обязательно для заполнения."
     *                      }
     *                  }
     *              }
     *         )
     *     )
     * )
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
                'error' => 'Something went wrong',
            ], 500);
        }
    }
}
