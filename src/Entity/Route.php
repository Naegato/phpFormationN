<?php

namespace App\Entity;
class Route
{
    public function __construct(private string $route, private string $controller, private string $function)
    {
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getFunction(): string
    {
        return $this->function;
    }



}