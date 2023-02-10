<?php

namespace App\Provider;

use App\Entity\Dependency;
use App\Interface\ProviderInterface;
use App\Interface\ProviderParentInterface;

class DependencyProvider extends ProviderParent implements ProviderInterface, ProviderParentInterface
{
    /**
     * @return Dependency[]
     */
    public function __invoke(): array
    {
        return parent::__invoke();
    }
}