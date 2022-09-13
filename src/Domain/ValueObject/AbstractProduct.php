<?php

declare(strict_types=1);

namespace FarmTestAssignment\Domain\ValueObject;

abstract class AbstractProduct
{
    public const DEFAULT_UNIT = 'ElementaryEntities';

    protected mixed $value;

    public function getValue()
    {
        return $this->value;
    }

    public function getUnit(): string
    {
        return static::DEFAULT_UNIT;
    }

    public function __toString()
    {
        return $this->getValue() . ' ' . $this->getUnit();
    }

    public function getType(): string
    {
        return (new \ReflectionClass(static::class))->getShortName();
    }

    static public function createFrom($unit, $value): static
    {
        return forward_static_call([static::class, "from$unit"], $value);
    }
}
