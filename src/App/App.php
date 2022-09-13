<?php

declare(strict_types=1);

namespace FarmTestAssignment\App;

use FarmTestAssignment\Domain\Entity\FarmInterface;

class App
{
    public function __construct(
        protected FarmInterface $farm,
    )
    {
    }

    /**
     * Создать и добавить животных.
     * $animals - массив вида string className => int count,
     * где className - имя класса животного (с неймспейсом),
     * count - количество создаваемых животных.
     *
     * @param array $animals
     * @return void
     */
    public function addAnimals(array $animals = []): void
    {
        foreach ($animals as $class => $num) {
            for ($counter = 0; $counter < $num; $counter++) {
                $this->farm->addAnimal(new $class());
            }
        }
    }

    /**
     * Еженедельные действия: произвести продукцию за 7 дней,
     * напечатать количество животных на ферме,
     * напечатать количество собранной продукции.
     *
     * @return void
     */
    public function weeklyActions(): void
    {
        $this->farm->produceInDays(7);
        $this->printFarmStats($this->farm->stats());
        $this->printHarvest($this->farm->harvest());
    }

    protected function printFarmStats(array $farmStats): void
    {
        $this->printFormattedData($farmStats, "There are", "no animals");
    }

    protected function printHarvest($harvest): void
    {
        foreach ($harvest as $key => $products) {
            $data = [];

            // change string like "sinceLastTime" to " since last time"
            $timeIntervalDescription = array_reduce(
                preg_split('/(?=[A-Z])/', $key),
                fn($carry, $item) => $carry . ' ' . strtolower($item),
                ''
            );

            foreach ($products as $type => $product) {
                $data[$type] = $product->getValue();
            }

            $this->printFormattedData($data, "Harvested$timeIntervalDescription", "nothing");
        }
    }

    protected function printFormattedData($data, $header, $messageForEmptyData): void
    {
        echo $header;

        if (empty($data)) {
            echo " $messageForEmptyData" . PHP_EOL;
        } else {
            echo PHP_EOL;
            array_walk($data, fn($value, $key) => print ("  - $key:  $value" . PHP_EOL));
        }

        echo PHP_EOL;
    }
}
