<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class ApiClient
{

    abstract protected function getClient(): Client;


    /**
     * @throws \Throwable
     */
    protected function requestGet(string $endpoint, array $params = []): array
    {
        $response = $this->getClient()->request('GET', $endpoint, [
            'query' => $params
        ]);

        return json_decode($response->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }
}
