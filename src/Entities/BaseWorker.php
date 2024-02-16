<?php

namespace App\Entities;

use App\Entities\Contracts\IWorker;
use App\Resources\Contracts\IResource;
use App\WorkPlace\Contracts\IWorkPlace;

abstract class BaseWorker implements IWorker
{
    protected string $name;
    protected string $occupation;
    protected int $productPerPeriod;
    protected bool $isWorking = false;

    /** @var IWorkPlace $currentWorkPlace */
    protected IWorkPlace $currentWorkPlace;
    protected int $maxHealth;
    protected int $currentHealth;
    protected int $hungerValue;
    protected int $hungerDamage;
    protected int $entityCost;
    protected int $maxEnergy;
    protected int $currentEnergy;
    protected int $currentLevel;
    protected int $currentExp;
    protected int $expToLvlUp;


    public function produceResources($resourcesToProduce): array
    {
        $producedResources = [];
        foreach ($resourcesToProduce as $resource) {
            $i = 1;
            while ($i <= $this->getProductPerPeriod()) {
                /** @var IResource $resource */
                $producedResources[] = new $resource();
                $i++;
            }
        }
        $this->assignProducer($producedResources);
        return $producedResources;
    }

    public function assignProducer($resources): void
    {
        foreach ($resources as $resource) {
            /** @var IResource $resource */
            $resource->setProducer($this);
        }
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getOccupation(): string
    {
        return $this->occupation;
    }

    public function getProductPerPeriod(): int
    {
        return $this->productPerPeriod;
    }

    public function setProductPerPeriod(int $productPerPeriod): void
    {
        $this->productPerPeriod = $productPerPeriod;
    }

    public function isWorking(): bool
    {
        return $this->isWorking;
    }

    public function setIsWorking(bool $isWorking): void
    {
        $this->isWorking = $isWorking;
    }

    public function getCurrentWorkPlace(): IWorkPlace
    {
        return $this->currentWorkPlace;
    }

    public function setCurrentWorkPlace(IWorkPlace $workPlace): void
    {
        $this->currentWorkPlace = $workPlace;
    }

    public function getMaxHealth(): int
    {
        return $this->maxHealth;
    }

    public function setMaxHealth(int $maxHealth): void
    {
        $this->maxHealth = $maxHealth;
    }

    public function getCurrentHealth(): int
    {
        return $this->currentHealth;
    }

    public function setCurrentHealth(int $currentHealth): void
    {
        $this->currentHealth = $currentHealth;
    }

    public function getHungerValue(): int
    {
        return $this->hungerValue;
    }

    public function setHungerValue(int $hungerValue): void
    {
        $this->hungerValue = $hungerValue;
    }

    public function getEntityCost(): int
    {
        return $this->entityCost;
    }

    public function setEntityCost(int $entityCost): void
    {
        $this->entityCost = $entityCost;
    }

    public function getMaxEnergy(): int
    {
        return $this->maxEnergy;
    }

    public function setMaxEnergy(int $maxEnergy): void
    {
        $this->maxEnergy = $maxEnergy;
    }

    public function getCurrentEnergy(): int
    {
        return $this->currentEnergy;
    }

    public function setCurrentEnergy(int $currentEnergy): void
    {
        $this->currentEnergy = $currentEnergy;
    }

    public function getHungerDamage(): int
    {
        return $this->hungerDamage;
    }

    public function getCurrentLevel(): int
    {
        return $this->currentLevel;
    }

    public function getCurrentExp(): int
    {
        return $this->currentExp;
    }

    public function getExpToLvlUp(): int
    {
        return $this->expToLvlUp;
    }

    public function setExpToLvlUp(int $expToLvlUp): void
    {
        $this->expToLvlUp = $expToLvlUp;
    }

}