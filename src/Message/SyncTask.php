<?php

namespace App\Message;

use App\Factory\ProviderFactory;

final class SyncTask
{
    private $providerFactory;

    public function __construct(ProviderFactory $providerFactory)
    {
        $this->providerFactory = $providerFactory;
    }

    public function getResult(): array
    {
        $provider = $this->providerFactory->getProvider();

        return $provider->getResult();
    }
}
