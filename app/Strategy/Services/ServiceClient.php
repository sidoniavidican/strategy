<?php

namespace App\Strategy\Services;

use App\Components\CurrencyClient;
use App\Components\Exceptions\UnableToRetrieveCurrenciesException;
use App\Strategy\InitialisationInterface;

class ServiceClient implements InitialisationInterface
{
    /**
     * @throws UnableToRetrieveCurrenciesException
     * @return string
     */
    public function getInitialisationData(): string
    {
        return app(CurrencyClient::class)->getCurrency('AUD');
    }
}
