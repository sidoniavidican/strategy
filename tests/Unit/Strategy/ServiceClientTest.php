<?php

namespace Tests\Unit\Strategy;

use App\Components\CurrencyClient;
use App\Components\Exceptions\UnableToRetrieveCurrenciesException;
use App\Strategy\Services\ServiceClient;
use Mockery\MockInterface;
use Tests\TestCase;

class ServiceClientTest extends TestCase
{
    /**
     * @throws UnableToRetrieveCurrenciesException
     */
    public function testGetInitialisationData(): void
    {
        $clientResponse = '{"title":"1 GBP = 1.84587538 AUD","link":"http:\/\/www.floatrates.com\/gbp\/aud\/"}';

        $this->mock(CurrencyClient::class, function (MockInterface $client) use ($clientResponse) {
            $client->shouldReceive('getCurrency')->once()->with('AUD')->andReturn($clientResponse);
        });

        $serviceClient = new ServiceClient();
        $data = $serviceClient->getInitialisationData();

        self::assertSame($data, $clientResponse);
    }
}
