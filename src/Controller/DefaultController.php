<?php

namespace App\Controller;
use App\Utils\Hello;

class DefaultController
{
    public function __construct(private Hello $hello)
    {
    }

    public function index()
    {
        $this->hello->hello();
    }
}