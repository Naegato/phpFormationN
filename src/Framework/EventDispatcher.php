<?php

namespace App\Framework;

use App\Interface\EventInterface;
use App\Interface\ListenerInterface;

class EventDispatcher
{
    private $listenersContainer = [];

    public function addListener(ListenerInterface $listener, string $eventName) {
        $this->listenersContainer[$eventName] = $listener;
    }

    public function dispatch(string $eventName,EventInterface $event ) {
        foreach ($this->listenersContainer as $key => $value) {
            if ($key === $eventName) {
                $value->handle($event);
            }
        }
    }

}