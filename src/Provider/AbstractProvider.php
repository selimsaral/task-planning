<?php

namespace App\Provider;

use App\Interfaces\ProviderInterface;
use Symfony\Component\HttpClient\HttpClient;

abstract class AbstractProvider implements ProviderInterface
{
    private $http;

    public function __construct()
    {
        $this->http = HttpClient::create();
    }

    public function fetch(string $endpoint): array
    {
        $response = $this->http->request('GET', $endpoint);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getContent(), true);
        }
    }


    abstract function getResult();
}