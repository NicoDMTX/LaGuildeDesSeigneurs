<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    /**
     * @Route("/player", name="player")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlayerController.php',
        ]);
    }

     /**
     * @Route("/player", name="player_redirect_index", methods={"GET","HEAD"})
     */
    public function redirectIndex()
    {
        return $this->redirectToRoute('player_index');
    }

    /**
    * @Route("/player/display/{identifier}", name="player_display", requirements={"identifier": "^([a-z0-9]{40})$"}, methods={"GET","HEAD"})
    */
    public function display(Player $player) 
    {
        return new JsonResponse($player->toArray());
    }

    /**
     * @Route("/player/create", name="player_create", methods={"POST","HEAD"})
     */
    public function create() 
    {
        $player = $this->playerService->create();
        $this->denyAccessUnlessGranted('characterCreate', $player);
        return new JsonResponse($player->toArray());
    }
}
