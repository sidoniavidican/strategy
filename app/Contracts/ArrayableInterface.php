<?php

namespace App\Contracts;

interface ArrayableInterface
{
    /**
     * @return array
     */
    public function toRestrictedArray(): array;
}
