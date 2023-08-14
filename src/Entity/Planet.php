<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\AddPlanetActionController;
use App\Controller\GetPlanetsActionController;
use App\Repository\PlanetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlanetRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/list',
            controller: GetPlanetsActionController::class,
            paginationEnabled: false
        ),
        new Post(
            uriTemplate: '/add',
            controller: AddPlanetActionController::class
        )
    ],
    routePrefix: '/planets',
    normalizationContext: null,
    denormalizationContext: null
)]
class Planet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['show'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show'])]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show'])]
    private ?string $description = null;

    #[ORM\Column(options: ["default" => 0])]
    #[Groups(['show'])]
    private ?int $status = 0;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $robotsExploring = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getRobotsExploring(): ?int
    {
        return $this->robotsExploring;
    }

    public function setRobotsExploring(int $robotsExploring): static
    {
        $this->robotsExploring = $robotsExploring;

        return $this;
    }
}
