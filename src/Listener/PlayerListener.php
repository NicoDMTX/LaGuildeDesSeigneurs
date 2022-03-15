<?php

namespace App\Listener;

use App\Event\PlayerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInteface;

class PlayerListener implements EventSubscriberInteface
{
    public static function getSubscribedEvents()
    {
        return array(
            PlayerEvent::CHARACTER_CREATED => 'PlayerCreated',
        );
    }

    public function PlayerCreated($event)
    {
        $player = $event->getPlayer();

        $player->setIntelligence(250);
    }
}