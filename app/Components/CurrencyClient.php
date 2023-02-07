<?php

namespace App\Components;

use App\Components\Exceptions\UnableToRetrieveCurrenciesException;
use App\Components\Exceptions\UnableToRetrieveCurrencyException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;

class CurrencyClient
{
    /**
     * @param string $currency
     * @throws UnableToRetrieveCurrenciesException
     * @return string
     */
    public function getCurrency(string $currency): string
    {
        try {
            $currencyXML = (new Client())->get('www.floatrates.com/daily/gbp.xml')->getBody()->getContents();
            $currencies  = new SimpleXMLElement($currencyXML);
            foreach ($currencies->item as $item) {
                if ((string)$item->targetCurrency === $currency) {
                    return json_encode($item, JSON_THROW_ON_ERROR);
                }
            }

            throw new UnableToRetrieveCurrencyException($currency);
        } catch (GuzzleException | Exception $exception) {
            throw new UnableToRetrieveCurrenciesException();
        }
    }
}
