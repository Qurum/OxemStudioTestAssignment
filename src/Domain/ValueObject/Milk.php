<?php

declare(strict_types=1);

namespace FarmTestAssignment\Domain\ValueObject;

use DomainException;

class Milk extends AbstractProduct
{
    public const DEFAULT_UNIT = 'Liters';

    public static function fromLiters(float $value): self
    {
        if ($value < 0) {
            throw new DomainException();
        }

        return new self($value);
    }

    private function __construct(float $value)
    {
        $this->value = $value;
    }
}
