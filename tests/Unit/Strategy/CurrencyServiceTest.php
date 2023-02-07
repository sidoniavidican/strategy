<?php

namespace Tests\Unit\Strategy;

use App\Components\CurrencyClient;
use App\Models\Currency;
use App\Strategy\CurrencyService;
use App\Strategy\Services\ServiceClient;
use App\Strategy\Services\ServiceDB;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery\MockInterface;
use Tests\TestCase;

class CurrencyServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return array
     */
    public function currencyDataProvider(): array
    {
        return [
            'With currency client' => [
                'currency' => new CurrencyClient(),
                'service'  => ServiceClient::class,
            ],
            'With currency object' => [
                'currency' => new Currency(),
                'service'  => ServiceDB::class,
            ],
        ];
    }

    /**
     * @dataProvider currencyDataProvider
     *
     * @param  mixed $currency
     * @param mixed $service
     *
     * @return void
     */
    public function testReturnCurrencyData(mixed $currency, mixed $service): void
    {
        Currency::factory()->create();

        $this->mock($service, function (MockInterface $service) {
            $service->shouldReceive('getInitialisationData')->andReturn('test');
        });

        $currencyService = app(CurrencyService::class);

        self::assertSame($currencyService->returnCurrencyData($currency), 'test');
    }

    /**
     * @dataProvider currencyDataProvider
     *
     * @param  mixed $currency
     * @param mixed $service
     *
     * @return void
     */
    public function testReturnCurrencyDataThrowsException(mixed $currency, mixed $service): void
    {
        Currency::factory()->create();

        $this->mock($service, function (MockInterface $service) {
            $service->shouldReceive('getInitialisationData')->andReturn('test');
        });

        $currencyService = app(CurrencyService::class);

        self::assertSame($currencyService->returnCurrencyData($currency), 'test');
    }
}
