<?php

namespace App\Workers\Contracts;

use App\UtilityPlace\Contracts\IUtility;
use App\WorkPlace\Contracts\IWorkPlace;

interface IWorker
{

    public function produceResources($resourcesToProduce): array;
    public function getName(): string;
    public function setName(string $name): void;
    public function getOccupation(): string;
    public function getProductPerPeriod(): int;
    public function setProductPerPeriod(int $productPerPeriod): void;
    public function isWorking(): bool;
    public function setIsWorking(bool $isWorking): void;
    public function getCurrentPlace();
    public function setCurrentPlace($currentPlace): void;
    public function getAssignedWorkPlace(): IWorkPlace;
    public function assignWorkPlace($workPlace): void;
    public function getMaxHealth(): int;
    public function getCurrentHealth(): int;
    public function setCurrentHealth(int $currentHealth): void;
    public function getHungerValue(): int;
    public function setHungerValue(int $hungerValue): void;
    public function getEntityCost(): int;
    public function getMaxEnergy(): int;
    public function getCurrentEnergy(): int;
    public function setCurrentEnergy(int $currentEnergy): void;
    public function getHungerDamage(): int;
    public function getCurrentLevel(): int;
    public function getCurrentExp(): int;
    public function getExpToLvlUp(): int;
    public function setExpToLvlUp(int $expToLvlUp): void;

}