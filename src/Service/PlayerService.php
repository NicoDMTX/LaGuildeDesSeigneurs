<?php 

namespace App\Service;

use DateTime;
use App\Entity\Player;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlayerService implements PlayerServiceInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em, PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function create() {
        $player = new Player();
        $player
            ->setFirstname('Nicolas')
            ->setLastname('Eldalote')
            ->setEmail('test@gmail.com')
            ->setMirian(12)
            ->setCreation(new \DateTime())
            ->setIdentifier(hash('sha1', uniqid()))
        ;
        $this->em->persist($player);
        $this->em->flush();
        return $player;
    }
}