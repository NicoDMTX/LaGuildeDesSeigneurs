<?php

namespace App\Service;

use DateTime;
use App\Entity\Character;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;

class CharacterService implements CharacterServiceInterface
{

    private $em;
    
    public function __construct(EntityManagerInterface $em, CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function create() {
        $character = new Character();
        $character
            ->setKind('Dame')
            ->setName('Eldalote')
            ->setSurname('Fleur elfique')
            ->setCaste('Elfe')
            ->setKnowledge('Arts')
            ->setIntelligence(120)
            ->setLife(12)
            ->setCreation(new \DateTime())
            ->setIdentifier(hash('sha1', uniqid()))
        ;
        $this->em->persist($character);
        $this->em->flush();
        return $character;
    }

    /**
     * @inheritdoc
     */
    public function getAll() {
        $charactersFinal = array();
        $characters = $this->characterRepository->findAll();
        foreach($character as $character) {
            $charactersFinal[] = $character->toArray();
        }
        return $charactersFinal;
    }

    /**
    * {@inheritdoc}
    */
    public function modify(Character $character)
    {
        $character
            ->setKind('Seigneur')
            ->setName('Gorthol')
            ->setSurname('Haume de terreur')
            ->setCaste('Chevalier')
            ->setKnowledge('Diplomatie')
            ->setIntelligence(110)
            ->setLife(13)
            ->setImage('/images/gorthol.jpg')
        ;
        $this->em->persist($character);
        $this->em->flush();
        return $character;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Character $character)
    {
        $this->em->remove($character);
        $this->em->flush();

        return true;
    }
}