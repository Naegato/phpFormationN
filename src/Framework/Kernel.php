<?php

namespace App\Framework;

use App\Builder\ContainerBuilder;
use App\Builder\YamlContainerBuilder;
use App\Event\KernelStartEvent;
use App\Provider\AttributesRouteProvider;
use App\Provider\YamlDependencyProvider;

class Kernel {
    public function __construct(string $route = null)
    {
        $container = (new ContainerBuilder((new YamlDependencyProvider('/../Framework/builder.yml'))()))();

        /** @var Router $router */
        $router = $container->getDependency('Router');


        $router->setRoute('/error/404', $container->getDependency('FrameworkController'), 'notFound');
        $router->setRoute('index', $container->getDependency('FrameworkController'), 'index');

        /** @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $container->getDependency('EventDispatcher');

        $eventDispatcher->dispatch('kernel.start', new KernelStartEvent($route));

        $routerResponse = $router->getRoute($route);

        if ($routerResponse instanceof \Symfony\Component\HttpFoundation\Response) {
            header(sprintf('Location: %s', $routerResponse->getContent()));
        }

        [$controller, $function, $parameters] = $routerResponse;
        echo $controller->$function(...($parameters ?? []))->getContent();
    }
}