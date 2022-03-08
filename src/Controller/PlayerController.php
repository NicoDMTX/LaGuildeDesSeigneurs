<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Player;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\PlayerServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

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
    public function redirectIndex(){
        return $this->redirectToRoute('player_index');
    }

   /** 
     *  Displays available Players
     *  @OA\Response(response=200,description="Success",
     *      @OA\Schema(type="array",
     *          @OA\Items(ref=@Model(type=Player::class))
     *      )
     *  )
     *  @OA\Response(response=403,description="Access denied")
     *  @OA\Tag(name="Player")
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('playerIndex', null);
        $players = $this->playerService->getAll();
        return new JsonResponse($players);
    }

   // DISPLAY
    /**
     *  Displays the Player
     *  @OA\Parameter(name="identifier",in="path",description="identifier for the Player",required=true)
     *  @OA\Response(response=200,description="Success",@Model(type=Player::class))
     *  @OA\Response(response=403,description="Access denied")
     *  @OA\Response(response=404,description="Not Found")
     *  @OA\Tag(name="Player")
     */
    public function display(Player $player) 
    {
        $this->denyAccessUnlessGranted('playerDisplay', $player);
        return new JsonResponse($player->toArray());
    }

   //CREATE
    /**
     *  Creates the Player
     *  @OA\Response(response=200,description="Success",@Model(type=Player::class))
     *  @OA\Response(response=403,description="Access denied")
     *  @OA\RequestBody(request="Player",description="Data for the Player",required=true,
     *      @OA\MediaType(mediaType="application/json",
     *      @OA\Schema(ref="#/components/schemas/Player")
     *      )
     *  )
     *  @OA\Tag(name="Player")
     */
    public function create() 
    {
        $this->denyAccessUnlessGranted('playerCreate', null);
        $player = $this->playerService->create();
        return new JsonResponse($player->toArray());
    }
    /**
     *  Modifies the Player
     *  @OA\Response(response=200,description="Success",@Model(type=Player::class))
     *  @OA\Response(response=403,description="Access denied",)
     *  @OA\Parameter(name="identifier",in="path",description="identifier for the Player",required=true)
     *  @OA\RequestBody(request="Player",description="Data for the Player",required=true,
     *      @OA\MediaType(mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Player")
     *      )
     *  )
     *  @OA\Tag(name="Player")
     */
    public function modify(Player $player)
    {
        $this->denyAccessUnlessGranted('playerModify', $player);
        $player = $this->playerService->modify($player);
        return new JsonResponse($player->toArray());
    }
    //DELETE
    /**
     *  Deletes the Player
     *  @OA\Response(response=200,description="Success",
     *      @OA\Schema(
     *          @OA\Property(property="delete", type="boolean")
     *      )
     *  )
     *  @OA\Response(response=403,description="Access denied")*
     *  @OA\Parameter(name="identifier",in="path",description="identifier for the Player",required=true)
     *  @OA\Tag(name="Player")
     */
    public function delete(Player $player)
    {
        $this->denyAccessUnlessGranted('playerModify', $player);
        $player = $this->playerService->delete($player);
        return new JsonResponse(array('delete' => $response));
    }
}
