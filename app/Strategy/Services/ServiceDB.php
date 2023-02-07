<?php

namespace App\Strategy\Services;

use App\Models\Currency;
use App\Strategy\InitialisationInterface;
use JsonException;
use function _PHPStan_4dd92cd93\React\Promise\Stream\first;

class ServiceDB implements InitialisationInterface
{
    /**
     * @return string
     * @throws JsonException
     */
    public function getInitialisationData(): string
    {
        return json_encode(Currency::where('name', 'test')->firstOrFail(), JSON_THROW_ON_ERROR);
    }
}
