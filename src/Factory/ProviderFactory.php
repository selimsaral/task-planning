<?php

namespace App\Factory;

use App\Interfaces\ProviderInterface;

class ProviderFactory
{
    private $provider;

    public function __construct(ProviderInterface $provider)
    {
        $this->provider = new $provider();
    }

    public function getProvider(): ProviderInterface
    {
        return $this->provider;
    }
}