<?php

namespace App\Handler;

use App\Message\RobotTransmission;
use App\Repository\PlanetRepository;
use Exception;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class RobotHandler
{
    private PlanetRepository $planetRepository;

    public function __construct(PlanetRepository $planetRepository)
    {
        $this->planetRepository = $planetRepository;
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

        $planet->setStatus(random_int(1,3));
    }
}
