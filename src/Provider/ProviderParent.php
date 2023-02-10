<?php

namespace App\Provider;

use App\Interface\ProviderInterface;
use App\Interface\ProviderParentInterface;

abstract class ProviderParent implements ProviderParentInterface, ProviderInterface
{
    /**
     * @var ProviderInterface[]
     */
    private readonly array $providers;
    public function __construct(...$providers)
    {
        $this->providers = $providers;
    }

    public function __invoke(): array
    {
        $array = [];

        foreach ($this->providers as $provider) {
            $array = [...$array, ...($provider())];
        }



        return $array;
    }
}