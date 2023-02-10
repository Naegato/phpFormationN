<?php

namespace App\Provider;

use App\Attributes\RouteAttribute;
use App\Entity\Route;
use App\Interface\ProviderInterface;
use ReflectionAttribute;

class AttributesRouteProvider extends AttributeProvider
{
    /**
     * @var string[]
     */
    private array $classes = [];

    /**
     * @param string[] ...$namespaces
     */
    public function __construct(...$namespaces)
    {
        foreach ($namespaces as $namespace) {
            $this->classes = [...$this->classes, ...$this->classes_in_namespace($namespace)];
        }
    }

    public function __invoke(): array
    {
        $array = [];

        foreach ($this->classes as $class) {
            $reflection = new \ReflectionClass($class);

            $methods = $reflection->getMethods();

            foreach ($methods as $method) {
                $attributes = $method->getAttributes(RouteAttribute::class, ReflectionAttribute::IS_INSTANCEOF);

                if (count($attributes) > 0) {
                    /** @var RouteAttribute $routeAttribute */
                    $routeAttribute = $attributes[0]->newInstance();
                    $array[] = new Route($routeAttribute->getPath(), $reflection->getShortName(), $method->getName());
                }
            }
        }

        return $array;
    }
}