<?php

namespace App\Dto;

use App\Helper\Traits\HydrateStaticTrait;

class PlanetOutputDto
{
    use HydrateStaticTrait;
    public ?string $name;
    public ?string $image;
    public ?string $description;
    public ?string $status;
}
