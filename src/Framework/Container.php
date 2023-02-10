<?php

namespace App\Framework;

use App\Entity\Dependency;
use App\Interface\BuilderInterface;

class Container
{

    /**
     * @var Dependency[];
     */
    private array $container = [];

    public function setDependency(Dependency $dependency): void
    {
      $this->container[$dependency->getKey()] = $dependency;
    }

    public function getDependency(string $id) {
        if ($id === 'Container') {
            return $this;
        }

        if (!$this->container[$id]->getInstance()) {
            if (!$this->container[$id]->getBuilder()) {
                $arguments = $this->container[$id]->getArgs();

                if ($arguments) {
                    foreach ($arguments as $key => $value) {
                        $isArray = is_array($value);

                        if (str_starts_with($isArray ? $value[0] : $value, '@')) {
                            if ($isArray) {
                                if ($value[1]) {
                                    $arguments[$key] = $this->getDependency(substr($value[0], 1))->$value[1]();
                                } else {
                                    $arguments[$key] = $this->getDependency(substr($value[0], 1))();
                                }
                            } else {
                                $arguments[$key] = $this->getDependency(substr($value, 1));
                            }
                        }
                    }
                }

                $this->container[$id]->setInstance(new ($this->container[$id]->getClass())(...($arguments ?? [])));
            } else {
                /** @var BuilderInterface $builder */
                $builder = $this->getDependency(substr($this->container[$id]->getBuilder(), 1));
                $this->container[$id]->setInstance($builder());
            }

            foreach ($this->container[$id]->getUse() as $function => $values) {
                foreach ($values as $parameters) {
                    foreach ($parameters as $key => $param) {
                        if (str_starts_with($param, '@')) {
                            $parameters[$key] = $this->getDependency(substr($param, 1));
                        }
                    }

                    $this->container[$id]->getInstance()->$function(...$parameters);
                }
            }
        }

        return $this->container[$id]->getInstance();
    }
}