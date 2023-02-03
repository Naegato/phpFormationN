<?php

namespace App\Framework;

class Container
{
    private array $container = [];

    public function setDependency(string $id, string $className, array $arguments, mixed $instance = null): void
    {
        $this->container[$id] = [
            'class' => $className,
            'arguments' => $arguments,
            'instance' => $instance,
        ];
    }

    private function setDependencyInstance(string $id, mixed $instance): void {
        $this->container[$id]['instance'] = $instance;
    }

    private function getRoutes() {
        return $this->container;
    }

    public function getDependency(string $id) {
        if (!$this->container[$id]['instance']) {
            $arguments = $this->container[$id]['arguments'];

            foreach ($arguments as $key => $value) {

                if (str_starts_with($value, '@')) {
                    $arguments[$key] = $this->getDependency(substr($value, 1));
                }
            }

            $instance = new ($this->container[$id]['class'])(...$arguments);
            $this->setDependencyInstance($id, $instance);
        }

        return $this->container[$id]['instance'];
    }

    public function getDependencies() {
        $array = [];

        foreach ($this->container as $key => $value) {
            $array[$key] = $this->getDependency($key);
        }

        return $array;
    }

    public function getContainer(): array {
        return $this->container;
    }

    public function getContainerWithDependencies(): array {
        $this->getDependencies();

        return $this->container;
    }


}