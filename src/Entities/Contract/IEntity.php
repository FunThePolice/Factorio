<?php

namespace App\Entities\Contract;

use App\WorkPlace\Contract\IWorkPlace;

interface IEntity
{
    public function getName(): string;
    public function setName(string $name): void;
    public function getOccupation(): string;
    public function getProductPerPeriod(): int;
    public function setProductPerPeriod(int $productPerPeriod): void;
    public function isWorking(): bool;
    public function setIsWorking(bool $isWorking): void;
    public function getCurrentWorkPlace(): IWorkPlace;
    public function setCurrentWorkPlace(IWorkPlace $workPlace): void;
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