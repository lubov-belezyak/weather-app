<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Query;
use Psr\Http\Message\RequestInterface;

class WeatherClient extends ApiClient
{
    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'base_uri' => config('openweathermap.base_url'),
            'handler' => $this->addDefaultQueryParameters()
        ]);
    }

    /**
     * @return string
     */
    protected function getCurrentWeatherUrl(): string
    {
        return 'data/' .
            config('openweathermap.api.current_weather.version') . '/' .
            config('openweathermap.api.current_weather.endpoint');
    }

    /**
     * @return HandlerStack
     */
    private function addDefaultQueryParameters(): HandlerStack
    {
        $defaultQueryParameters = [
            'appid' => config('openweathermap.appid'),
            'units' => config('openweathermap.units'),
            'lang' => config('openweathermap.lang'),
        ];
        $stack = HandlerStack::create();
        $stack->push(Middleware::mapRequest(function (RequestInterface $request) use ($defaultQueryParameters) {
            $query = Query::parse($request->getUri()->getQuery());
            $query = array_merge($defaultQueryParameters, $query);
            return $request->withUri($request->getUri()->withQuery(Query::build($query)));
        }));
        return $stack;
    }

    /**
     * @param WeatherRequestParams $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function getCurrentWeatherByCity(WeatherRequestParams $params): array
    {
        $params = [
            'q' => implode(',', array_filter([$params->getCity(), $params->getStateCode(), $params->getCountryCode()])),
            'mode' => $params->getMode(),
            'units' => $params->getUnits(),
            'lang' => $params->getLang(),
        ];
        return $this->requestGet($this->getCurrentWeatherUrl(), array_filter($params));
    }

}
