<?php

namespace App\Components\Exceptions;

use Exception;
use Throwable;

/**
 * @method UnableToRetrieveCurrenciesException withException(Throwable $throwable)
 * @method UnableToRetrieveCurrenciesException withMetaData(array $metadata, $key = 'additional')
 */
class UnableToRetrieveCurrenciesException extends Exception
{
    public const MESSAGE = 'Unable to retrieve currencies';
    public const CODE = 9002;
}
