<?php

namespace App\Controller;

use App\Entity\Planet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AddPlanetActionController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request): Response
    {
        $content = $request->getContent();
        $json = json_decode($content, true);

        $name = $json['name'];
        $description = $json['description'] ?? null;
        $image = $json['image'] ?? null;

        $planet = new Planet();
        $planet->setName($name);
        $planet->setDescription($description);
        $planet->setImage($image);

        $this->entityManager->persist($planet);
        $this->entityManager->flush();

        return new Response($this->serializer->serialize($planet, 'json'),200);
    }
}
