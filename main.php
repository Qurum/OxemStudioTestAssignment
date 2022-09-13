<?php

declare(strict_types=1);

use FarmTestAssignment\App\App;
use FarmTestAssignment\Domain\Entity\Animal\Cow;
use FarmTestAssignment\Domain\Entity\Animal\Hen;
use FarmTestAssignment\Infrastructure\DefaultFarm;

require "vendor/autoload.php";

$app = new App(new DefaultFarm());

$app->addAnimals([Cow::class => 10, Hen::class => 20]);
$app->weeklyActions();

$app->addAnimals([Cow::class => 1, Hen::class => 5]);
$app->weeklyActions();
