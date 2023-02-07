<?php

namespace App\Components\Exceptions;

use Exception;
use Throwable;

/**
 * @method UnableToRetrieveCurrencyException withException(Throwable $throwable)
 * @method UnableToRetrieveCurrencyException withMetaData(array $metadata, $key = 'additional')
 */
class UnableToRetrieveCurrencyException extends Exception
{
    public const MESSAGE = 'Unable to retrieve currency for %s';
    public const CODE = 9001;
}
