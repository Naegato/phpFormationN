<?php

namespace App\Event;

use App\Interface\EventInterface;

class KernelStartEvent implements EventInterface
{
    public function __construct(private string $path)
    {
    }

    public function use(): string
    {
        return $this->path;
    }
}