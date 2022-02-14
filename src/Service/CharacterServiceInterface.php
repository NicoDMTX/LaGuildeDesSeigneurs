<?php

namespace App\Service;

use App\Entity\Character;
use Doctrine\ORM\EntityManagerInterface;

interface CharacterServiceInterface
{
    /**
     * Creates the character
     */
    public function create();

    /**
     * getho
     */
    public function getAll();

    /**
     * Modifies the character
     */
    public function modify(Character $character);

    /**
     * Delete a character
     */
    public function delete(Character $character);
}