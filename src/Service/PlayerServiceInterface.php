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

    /**
     * getho
     */
    public function getAll();

    /**
     * Modifies the player
     */
    public function modify(Player $player);

    /**
     * Delete a player
     */
    public function delete(Player $player);
}