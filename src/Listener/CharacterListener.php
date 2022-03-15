<?php

namespace App\Listener;

use App\Event\CharacterEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInteface;

class CharacterListener implements EventSubscriberInteface
{
    public static function getSubscribedEvents()
    {
        return array(
            CharacterEvent::CHARACTER_CREATED => 'characterCreated',
        );
    }

    public function characterCreated($event)
    {
        $character = $event->getCharacter();

        $character->setIntelligence(250);
    }
}