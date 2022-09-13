<?php

declare(strict_types=1);

namespace FarmTestAssignment\Domain\Entity\Animal;

use FarmTestAssignment\Domain\ValueObject\Milk;

class Cow extends AbstractAnimal
{
    private const MIN = 8;
    private const MAX = 12;

    public function produce(): Milk
    {
        $decimals = 2;
        $div      = pow(10, $decimals);
        $liters   = (rand(self::MIN * $div, self::MAX * $div)) / $div;

        return Milk::fromLiters($liters);
    }
}
