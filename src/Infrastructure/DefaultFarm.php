<?php

declare(strict_types=1);

namespace FarmTestAssignment\Infrastructure;

use FarmTestAssignment\Domain\Entity\Animal\AbstractAnimal;
use FarmTestAssignment\Domain\Entity\FarmInterface;
use FarmTestAssignment\Domain\ValueObject\AbstractProduct;

class DefaultFarm implements FarmInterface
{
    /** @var AbstractAnimal[] */
    private array $animals = [];

    /** @var AbstractProduct[] */
    private array $productsSinceLastTime = [];

    /** @var AbstractProduct[] */
    private array $productsTotal = [];

    /**
     * @inheritdoc
     */
    public function addAnimal(AbstractAnimal $animal): void
    {
        $this->animals[$animal->getId()] = $animal;
    }

    /**
     * @inheritdoc
     */
    public function getAnimals(): array
    {
        return $this->animals;
    }

    /**
     * @inheritdoc
     */
    public function removeAnimal(AbstractAnimal $animal): void
    {
        unset($this->animals[$animal->getId()]);
    }

    /**
     * @inheritdoc
     */
    public function stats(): array
    {
        $animalStats = [];

        foreach ($this->getAnimals() as $animal) {
            $type               = $animal->getType();
            $animalStats[$type] = ($animalStats[$type] ?? 0) + 1;
        }

        ksort($animalStats);

        return $animalStats;
    }

    /**
     * @inheritdoc
     */
    public function produceInDays(int $days = 7): void
    {
        for ($counter = 0; $counter < $days; $counter++) {
            $this->produce();
        }
    }

    /**
     * @inheritdoc
     */
    public function harvest(): array
    {
        $result = [
            'sinceLastTime' => $this->productsSinceLastTime,
            'total'         => $this->productsTotal,
        ];

        array_walk($result, fn(&$value) => ksort($value));

        $this->productsSinceLastTime = [];

        return $result;
    }

    /**
     * Произвести продукцию за один день
     *
     * @return void
     */
    protected function produce(): void
    {
        foreach ($this->animals as $animal) {
            $product = $animal->produce();
            $this->incProducts($product, 'productsSinceLastTime');
            $this->incProducts($product, 'productsTotal');
        }
    }

    /**
     * Увеличить счётчик $key продукции, добавив $product
     *
     * @param $product
     * @param $key
     * @return void
     */
    protected function incProducts($product, $key): void
    {
        $type      = $product->getType();
        $harvested = !array_key_exists($type, $this->{$key})
            ? 0
            : $this->{$key}[$type]->getValue();

        $this->{$key}[$type] = $product::createFrom(
            $product::DEFAULT_UNIT,
            $harvested + $product->getValue()
        );
    }
}
