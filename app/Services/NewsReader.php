<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;

class NewsReader
{
    private Client $httpClient;

    /**
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function read(): string
    {
        return $this->httpClient
            ->get('https://news.ycombinator.com/')
            ->getBody()
            ->getContents();
    }
}
