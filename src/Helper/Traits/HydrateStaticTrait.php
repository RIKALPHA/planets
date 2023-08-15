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
                if ($key === 'status') {
                    $dto->status = Planet::CORRELATION[$value];
                } else {
                    $dto->$key = $value;
                }
            }
        }

        return $dto;
    }

    public static function hydrateFromObject(object $object): self
    {
        $dto = new self();
        foreach ($object as $key => $value) {
            if (property_exists($object, $key)) {
                if ($key === 'status') {
                    $dto->status = Planet::CORRELATION[$value];
                } else {
                    $dto->$key = $value;
                }
            }
        }

        return $dto;
    }
}
