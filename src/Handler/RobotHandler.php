<?php

namespace App\Handler;

use App\Message\RobotTransmission;
use App\Repository\PlanetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

//php bin/console messenger:consume -vv external_messages
#[AsMessageHandler]
class RobotHandler
{
    private PlanetRepository $planetRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, PlanetRepository $planetRepository)
    {
        $this->planetRepository = $planetRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @throws Exception
     */
    public function __invoke(RobotTransmission $robot): void
    {
        $robotArrivedOnPlanetId = $robot->getPlanetId();

        $planet = $this->planetRepository->find($robotArrivedOnPlanetId);
        if ($planet === null) {
            throw new Exception('Planet Not found.');
        }
        if($planet->getStatus() === 0) {
            $planet->setStatus(1);
        }

        $this->entityManager->persist($planet);
        $this->entityManager->flush();
    }
}
