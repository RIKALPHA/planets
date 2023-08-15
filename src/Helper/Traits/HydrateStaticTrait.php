<?php

namespace App\Helper\Traits;

use App\Entity\Planet;

trait HydrateStaticTrait
{
    public static function hydrate(array $values): self
    {
        $dto = new self();
        foreach ($values as $key => $value) {
            if (property_exists($dto, $key)) {
                if (in_array($key,['name', 'description'])) {
                    $dto->$key = $value ?? '';
                } else if ($key === 'status') {
                    $dto->status = Planet::CORRELATION[$value];
                } else {
                    $dto->$key = $value;
                }
            }
        }

        return $dto;
    }
}
