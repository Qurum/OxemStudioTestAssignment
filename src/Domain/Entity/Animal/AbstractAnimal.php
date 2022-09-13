<?php

declare(strict_types=1);

namespace FarmTestAssignment\Domain\Entity\Animal;

use FarmTestAssignment\Domain\ValueObject\AbstractProduct;

abstract class AbstractAnimal
{
    private string $uuid;

    public function __construct()
    {
        $this->uuid = uniqid();
    }

    public function getId(): string
    {
        return $this->uuid;
    }

    public function getType(): string
    {
        return (new \ReflectionClass(static::class))->getShortName();
    }

    abstract function produce(): AbstractProduct;
}
