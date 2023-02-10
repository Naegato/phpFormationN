<?php

namespace App\Interface;

interface ControllerInterface
{
    public function twigRender(string $path, array $options = []);
}