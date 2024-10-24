<?php

namespace Tests\Feature;

use App\Services\WeatherClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Mockery;
use Tests\TestCase;

class WeatherApiTest extends TestCase
{
    /**
     * @return void
     */
    public function test_get_weather_api_by_city_success()
    {
        $response = $this->json('GET', '/api/weather', [
            'city' => 'Екатеринбург'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'city',
                'temperature',
                'weatherDescription',
                'windSpeed',
                'pressure',
                'humidity',
                'iconUrl',
                'rainProbability'
            ]);
    }

    public function test_validation_error_when_city_is_missing()
    {
        $response = $this->json('GET', '/api/weather', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['city']);
    }

    public function test_api_open_weather_error()
    {
        $mock = Mockery::mock(WeatherClient::class);
        $mock->shouldReceive('request')
            ->andThrow(new RequestException('Internal Server Error', new Request('GET', 'test')));

        $this->app->instance(WeatherClient::class, $mock);
        $response = $this->json('GET', '/api/weather', [
            'city' => 'Екатеринбург'
        ]);

        $response->assertStatus(500)
            ->assertJson([
                'error' => 'Something went wrong'
            ]);
    }
}
