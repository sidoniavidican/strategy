<?php

namespace Tests\Unit\Strategy;

use App\Models\Currency;
use App\Strategy\Services\ServiceDB;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use JsonException;
use Tests\TestCase;

class ServiceDBTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @throws JsonException
     */
    public function testGetInitialisationData(): void
    {
        Currency::factory()->create(['name' => 'test', 'value' => 22.22]);

        $serviceClient = new ServiceDB();
        $data = $serviceClient->getInitialisationData();

        self::assertSame($data, json_encode(['name' => 'test', 'value' => 22.22]));
    }
}
