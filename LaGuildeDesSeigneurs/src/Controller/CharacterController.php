<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Character;
use Symfony\Component\HttpFoundation\JsonResponse;

class CharacterController extends AbstractController
{
    /**
     * @Route("/character/display", name="character_display")
     */
    public function display() 
    {
        $character = new Character();
        dump($character); 
        dd($character->toArray());
        return new JsonReponse($character->toArray());
    }
}
