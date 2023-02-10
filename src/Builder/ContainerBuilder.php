<?php

namespace App\Builder;

use App\Entity\Dependency;
use App\Framework\Container;
use App\Interface\BuilderInterface;

class ContainerBuilder implements BuilderInterface
{

    /**
     * @param Dependency[] $dependencies
     */
    public function __construct(private readonly array $dependencies)
    {
    }

    public function __invoke() : Container
    {
        $container = new Container();

        foreach ($this->dependencies as $dependency) {
            $container->setDependency($dependency);
        }

        return $container;
    }
}