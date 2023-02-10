<?php

namespace App\Interface;

interface ProviderInterface
{
    public function __invoke(): array;
}