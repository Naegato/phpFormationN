<?php

namespace App\Framework;

use App\Framework\Builder;
use App\Framework\Container;

class Kernel {
    public function __construct(string $route = null)
    {
        echo '<pre>';

        $container = Builder::build(__DIR__.'/builder.yml');

        var_dump($container->getContainer());

        echo '</pre>';
    }
}