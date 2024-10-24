<?php

namespace App\Services;

use GuzzleHttp\Client;

abstract class ApiClient
{
    abstract protected function getClient(): Client;

    /**
     * @param string $endpoint
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    protected function requestGet(string $endpoint, array $params = []): array
    {
        $response = $this->getClient()->request('GET', $endpoint, [
            'query' => $params
        ]);

        return json_decode($response->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
    }

    /**
     * to be continued
     */
    protected function requestPost(string $endpoint, array $params = []): array {
        return [];
    }

    protected function requestPut(string $endpoint, array $params = []): array {
        return [];
    }

    protected function requestDelete(string $endpoint, array $params = []): array {
        return [];
    }
}
