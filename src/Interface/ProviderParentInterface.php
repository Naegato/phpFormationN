<?php

namespace App\Interface;

interface ProviderParentInterface
{
    /**
     * @param ProviderInterface[] ...$providers
     */
    public function __construct(...$providers);
}