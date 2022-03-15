<?php

namespace App\Service;

use App\Entity\Character;

interface CharacterServiceInterface
{
    /**
     * create the character
     */
    public function create(string $data);
    /**
     * Checks if the entity has been well filled
     */
    public function isEntityFilled(Character $character);
    /**
     * Submits the data to hydrate the object
     */
    public function submit(Character $character, $formName, $data);
    /**
     * Gets all the characters
     */
    public function getAll();
    /**
     * Gets all the characters whose intelligence level is greater than or equal to a number passed in the url.
     */
    public function getIntellectAbove(int $number);
    /**
    * Modifies the character
    */
    public function modify(Character $character, string $data);
    /**
    * Delete the character
    */
    public function delete(Character $character);
    /**
    * Gets images randomly using kind
    */
    public function getImages(int $number, ?string $kind = null);
}