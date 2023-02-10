<?php

namespace App\Interface;

interface ListenerInterface
{
    public function handle(EventInterface $event);
}