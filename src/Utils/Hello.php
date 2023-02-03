<?php

namespace App\Utils;

class Hello
{

    public function __construct(private string $name)
    {
    }

    public function hello() {
        echo 'hello'.$this->name;
    }

    public function bye() {
        echo 'bye'.$this->name;
    }
}