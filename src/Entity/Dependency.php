<?php

namespace App\Entity;

use App\Interface\BuilderInterface;

class Dependency
{
    public function __construct(
        private mixed $instance = null,
        private readonly ?string $key = null,
        private readonly ?string $class = null,
        private readonly array  $args = [],
        private readonly array  $use = [],
        private readonly ?string $builder = null
    ) {
    }

    /**
     * @param mixed $instance
     */
    public function setInstance(mixed $instance): void
    {
        $this->instance = $instance;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * @return mixed
     */
    public function getInstance(): mixed
    {
        return $this->instance;
    }

    /**
     * @return mixed
     */
    public function getBuilder(): mixed
    {
        return $this->builder;
    }

    /**
     * @return array
     */
    public function getUse(): array
    {
        return $this->use;
    }
}