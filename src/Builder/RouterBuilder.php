<?php

namespace App\Builder;

use App\Entity\Route;
use App\Framework\Container;
use App\Framework\Router;
use App\Interface\BuilderInterface;

class RouterBuilder implements BuilderInterface
{
    /**
     * @param Route[] $routes
     */
    public function __construct(private readonly array $routes, private readonly Container $container)
    {
    }

    public function __invoke()
    {
        $router = new Router();

        foreach ($this->routes as $route) {
            $router->setRoute($route->getRoute(), $this->container->getDependency($route->getController()), $route->getFunction());
        }

        return $router;
    }
}