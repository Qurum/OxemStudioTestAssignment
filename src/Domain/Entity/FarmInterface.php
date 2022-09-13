<?php

declare(strict_types=1);

namespace FarmTestAssignment\Domain\Entity;

use FarmTestAssignment\Domain\Entity\Animal\AbstractAnimal;
use FarmTestAssignment\Domain\ValueObject\AbstractProduct;

interface FarmInterface
{
    /**
     * Добавить животное на ферму.
     *
     * @param AbstractAnimal $animal
     * @return void
     */
    public function addAnimal(AbstractAnimal $animal): void;

    /**
     * Массив всех животных на ферме.
     * string uuid => AbstractAnimal
     *
     * @return AbstractAnimal[]
     */
    public function getAnimals(): array;

    /**
     * Убрать животное с фермы.
     * Если животного нет на ферме - ничего не произойдёт.
     *
     * @param AbstractAnimal $animal
     * @return void
     */
    public function removeAnimal(AbstractAnimal $animal): void;

    /**
     * Количество животных на ферме.
     *
     * Массив вида string type => integer
     *
     * @return array
     */
    public function stats(): array;

    /**
     * Произвести продукцию за несколько дней.
     *
     * @param int $days
     * @return void
     */
    public function produceInDays(int $days): void;

    /**
     * Собрать продукцию.
     *
     * Массив с ключами sinceLastTime и total,
     * соответствующими подмассивам вида string type => AbstractProduct
     *
     * @return AbstractProduct[]
     */
    public function harvest(): array;
}
