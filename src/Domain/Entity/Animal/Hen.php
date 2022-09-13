<?php

declare(strict_types=1);

namespace FarmTestAssignment\Domain\Entity\Animal;

use FarmTestAssignment\Domain\ValueObject\Eggs;

class Hen extends AbstractAnimal
{
    private const MIN = 0;
    private const MAX = 1;

    public function produce(): Eggs
    {
        return Eggs::fromPieces(rand(self::MIN, self::MAX));
    }
}
