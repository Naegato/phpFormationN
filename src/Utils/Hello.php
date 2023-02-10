<?php

namespace App\Utils;

use Symfony\Component\Routing\Annotation\Route;

class Hello
{

    public function __construct(private string $name)
    {
    }

    public function hello(): string
    {
        return 'hello '.$this->name;
    }

    public function bye(): string
    {
        return 'bye '.$this->name;
    }
}