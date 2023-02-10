<?php

namespace App\Listener;

use App\Interface\EventInterface;
use App\Interface\ListenerInterface;

class ListenerLog implements ListenerInterface
{
    public function handle(EventInterface $event)
    {
        $myfile = fopen(__DIR__.'/../logs/log.log', 'a') or die("Unable to open file!");
        fwrite($myfile, time().' | '.((new \DateTime())->format('Y-m-d H:i:s')).' | access to '.$event->use()." \n");
        fclose($myfile);
    }
}