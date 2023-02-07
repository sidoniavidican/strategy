<?php

namespace App\Strategy;

use App\Components\CurrencyClient;
use App\Components\Exceptions\UnableToRetrieveCurrenciesException;
use App\Models\Currency;
use App\Strategy\Services\ServiceClient;
use App\Strategy\Services\ServiceDB;
use Exception;
use JsonException;

class CurrencyService
{
    /**
     * @param mixed $currency
     *
     * @return string
     * @throws Exception
     * @throws UnableToRetrieveCurrenciesException
     * @throws JsonException
     */
    public function returnCurrencyData(mixed $currency): string
    {
        $service = match (get_class($currency)) {
            Currency::class => app(ServiceDB::class),
            CurrencyClient::class => app(ServiceClient::class),
            default => throw new Exception("Unknown type"),
        };

        return $service->getInitialisationData();
    }
}
