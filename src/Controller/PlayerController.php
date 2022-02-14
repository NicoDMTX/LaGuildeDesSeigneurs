<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Player;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\PlayerServiceInterface;

class PlayerController extends AbstractController
{

    private $playerService;

    public function __construct(PlayerServiceInterface $playerService)
    {
        $this->playerService = $playerService;
    }

     /**
     * @Route("/player", name="player_redirect_index", methods={"GET","HEAD"})
     */
    public function redirectIndex()
    {
        return $this->redirectToRoute('player_index');
    }

    /**
     * @Route("/player/index", name="player_index", methods={"GET","HEAD"})
     */
    public function index()
    {
        $this->denyAccesUnlessGranted('playerIndex', null);
        $players = $this->playerService->getAll();
        return new JsonResponse($players);
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
        $this->denyAccessUnlessGranted('playerCreate', $player);
        return new JsonResponse($player->toArray());
    }

    //MODIFY
    /**
     * @Route("/player/modify/{identifier}", 
     *      name="player_modify",
     *      requirements={"identifier": "^([a-z0-9]{40})$"},
     *      methods={"PUT", "HEAD"}
     * 
     * )
     */
    public function modifiy(Player $player)
    {
        $this->denyAccessUnlessGranted('playerModify', $player);

        $player = $this->playerService->modify($player);

        return new JsonResponse($player->toArray() );
    }

    //DELETE
    /**
     * @Route("/player/delete/{identifier}",
     *      name="player_delete",
     *      requirements={"identifier": "^([a-z0-9]{40})$"},
     *      methods={"DELETE", "HEAD"}
     * )
     */
    public function delete(Player $player)
    {
        $this->denyAccessUnlessGranted('playerDelete', $player);
        $response = $this->playerService->delete($player);
        return new JsonResponse(array('delete' => $response));
    }
}
