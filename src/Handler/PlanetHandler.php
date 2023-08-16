<?php

namespace App\Handler;

use App\Message\PlanetUpdate;
use App\Repository\PlanetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

//php bin/console messenger:consume -vv external_messages
#[AsMessageHandler]
class PlanetHandler
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
    public function __invoke(PlanetUpdate $planetUpdate): void
    {
        $planetId = $planetUpdate->getId();

        $planet = $this->planetRepository->find($planetId);
        if ($planet === null) {
            throw new Exception('Planet Not found.');
        }
        if ($planet->getStatus() !== 1) {
            throw new Exception('Planet cannot be updated.');
        }

        $planet->setDescription($planetUpdate->getDescription());
        $planet->setStatus($planetUpdate->getStatus());

        $this->entityManager->persist($planet);
        $this->entityManager->flush();
    }
}
