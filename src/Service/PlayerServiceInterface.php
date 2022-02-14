<?php

namespace App\Service;

use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;

interface PlayerServiceInterface
{
    /**
     * Creates the player
     */
    public function create();
}