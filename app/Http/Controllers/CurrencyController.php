<?php

namespace App\Http\Controllers;

use App\Components\CurrencyClient;
use App\Components\Exceptions\UnableToRetrieveCurrenciesException;

class CurrencyController extends Controller
{
    /**
     * @param CurrencyClient $currencyClient
     *
     * @return string
     * @throws UnableToRetrieveCurrenciesException
     */
    public function getAustralianDollars(CurrencyClient $currencyClient): string
    {
        return $currencyClient->getCurrency('AUD');
    }
}
