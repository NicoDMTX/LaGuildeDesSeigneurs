<?php

namespace App\Event;

use App\Entity\Character;
use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\Player;

class CharacterEvent extends Event
{
    public const CHARACTER_CREATED = 'app.character.created';

    protected $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function getCharacter()
    {
        return $this->character;
    }

    public function setLifeDate()
    {
        $today = date("F j, Y, g:i a");
        dd($today);
    }
}