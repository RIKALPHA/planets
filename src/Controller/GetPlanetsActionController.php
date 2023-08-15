<?php

namespace App\Controller;

use App\Dto\PlanetOutputDto;
use App\Repository\PlanetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class GetPlanetsActionController extends AbstractController
{
    private PlanetRepository $planetRepository;
    private SerializerInterface $serializer;

    public function __construct(PlanetRepository $planetRepository, SerializerInterface $serializer)
    {
        $this->planetRepository = $planetRepository;
        $this->serializer = $serializer;
    }

    public function __invoke(): Response
    {
        $planets = $this->planetRepository->findAll();

        $responsePlanets = [];
        foreach($planets as $planet) {
            $responsePlanets[] = PlanetOutputDto::hydrate((array)$planet);
        }

        return new Response($this->serializer->serialize($responsePlanets, 'json'),200);
    }
}
