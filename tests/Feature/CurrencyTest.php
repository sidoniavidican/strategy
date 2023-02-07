<?php

namespace Tests\Feature;

use App\Components\CurrencyClient;
use App\Components\Exceptions\UnableToRetrieveCurrenciesException;
use App\Components\Exceptions\UnableToRetrieveCurrencyException;
use JsonException;
use Mockery\MockInterface;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testCurrency(): void
    {
        $clientResponse = '{"title":"1 GBP = 1.73887049 AUD","link":"http:\/\/www.floatrates.com\/gbp\/aud\/"}';

        $this->mock(CurrencyClient::class, function (MockInterface $client) use ($clientResponse) {
            $client->shouldReceive('getCurrency')->once()->with('AUD')->andReturn($clientResponse);
        });

        $response = $this->get('/currency/australian-dollars');

        $response->assertStatus(200)
            ->assertJson(json_decode($clientResponse, true));
    }

    /**
     */
    public function testCurrencyWhenCurrencyNotFound(): void
    {
        $this->mock(CurrencyClient::class, function (MockInterface $client) {
            $client->shouldReceive('getCurrency')->once()->with('AUD')->andThrow(new UnableToRetrieveCurrencyException('AUD'));
        });

        $response = $this->get('/currency/australian-dollars');

        $response->assertStatus(500);
        self::assertInstanceOf(UnableToRetrieveCurrencyException::class, $response->exception);
    }

    /**
     */
    public function testCurrencyWhenGuzzleException(): void
    {
        $this->mock(CurrencyClient::class, function (MockInterface $client) {
            $client->shouldReceive('getCurrency')->once()->with('AUD')->andThrow(new UnableToRetrieveCurrenciesException());
        });

        $response = $this->get('/currency/australian-dollars');

        $response->assertStatus(500);
        self::assertInstanceOf(UnableToRetrieveCurrenciesException::class, $response->exception);
    }
}
