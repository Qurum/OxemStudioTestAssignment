<?php

declare(strict_types=1);

namespace FarmTestAssignment\Domain\ValueObject;

use DomainException;

class Eggs extends AbstractProduct
{
    public const DEFAULT_UNIT = 'Pieces';

    public static function fromPieces(int $value): self
    {
        if ($value < 0) {
            throw new DomainException();
        }

        return new self($value);
    }

    private function __construct(int $value)
    {
        $this->value = $value;
    }
}
