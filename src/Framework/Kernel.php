<?php

namespace App\Framework;

use App\Framework\Builder;
use App\Framework\Container;

class Kernel {
    public function __construct(string $route = null)
    {
        echo '<pre>';
        $container = new Container();

        Builder::build(__DIR__.'/builder.yml', $container);

        $router = $container->getDependency('Router');
        $router->toRoute($route);

        echo '</pre>';
    }
}