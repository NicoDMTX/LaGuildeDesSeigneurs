<?php

namespace App\Event;

use App\Entity\Player;
use Symfony\Contracts\EventDispatcher\Event;

class PlayerEvent extends Event
{
    public const CHARACTER_CREATED = 'app.player.created';

    protected $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function setLifeDate()
    {
        $today = date("F j, Y, g:i a");
        dd($today);
    }
}