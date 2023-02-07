<?php

namespace App\Strategy;

interface InitialisationInterface
{
    /**
     * @return string
     */
    public function getInitialisationData(): string;
}
