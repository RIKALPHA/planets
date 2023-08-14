<?php

namespace App\Controller;

use App\Repository\PlanetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Context\Normalizer\ObjectNormalizerContextBuilder;
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

        return new Response($this->serializer->serialize($planets, 'json'),200);
//        return $this->render('get_planets_action/index.html.twig', [
//            'controller_name' => 'GetPlanetsActionController',
//        ]);
    }
}
