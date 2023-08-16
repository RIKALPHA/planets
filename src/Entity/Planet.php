<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\AddPlanetActionController;
use App\Controller\GetPlanetsActionController;
use App\Dto\PlanetOutputDto;
use App\Repository\PlanetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlanetRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/list',
            controller: GetPlanetsActionController::class,
            paginationEnabled: false,
            output: PlanetOutputDto::class
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
    public const STATUS_TODO = "TODO";
    public const STATUS_ENR = "En route";
    public const STATUS_OK = "OK";
    public const STATUS_NOK = "NOK";

    public const CORRELATION = [
        0 => self::STATUS_TODO,
        1 => self::STATUS_ENR,
        2 => self::STATUS_OK,
        3 => self::STATUS_NOK,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['show'])]
    public ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show'])]
    public ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['show'])]
    public ?string $description = null;

    #[ORM\Column(options: ["default" => 0])]
    #[Groups(['show'])]
    public ?int $status = 0;

    #[ORM\Column(options: ["default" => 0])]
    public ?int $robotsExploring = 0;

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
