<?php

namespace App\Provider;

use App\Entity\Route;
use App\Interface\ProviderInterface;
use App\Interface\ProviderParentInterface;

class RouteProvider extends ProviderParent implements ProviderInterface, ProviderParentInterface
{
    /**
     * @return Route[]
     */
    public function __invoke(): array
    {
        return parent::__invoke();
    }
}