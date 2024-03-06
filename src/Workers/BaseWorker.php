<?php

namespace App\Workers;

use App\Resources\Contracts\IResource;
use App\State\State;
use App\UtilityPlace\Contracts\IHeal;
use App\UtilityPlace\Contracts\IRest;
use App\Workers\Contracts\IWorker;
use App\Workers\WorkerProcessing\Heal;
use App\Workers\WorkerProcessing\Rest;
use App\Workers\WorkerProcessing\Work;
use App\WorkPlace\Contracts\IWorkPlace;
use Exception;

abstract class BaseWorker implements IWorker
{
    protected string $name;
    protected string $occupation;
    protected int $productPerPeriod;
    protected bool $isWorking = false;
    protected object $currentPlace;
    protected int $maxHealth = 100;
    protected int $currentHealth = 100;
    protected int $hungerValue = 0;
    protected int $hungerDamage = 0;
    protected int $entityCost;
    protected int $maxEnergy;
    protected int $currentEnergy;
    protected int $currentLevel = 1;
    protected int $currentExp = 0;
    protected int $expToLvlUp = 200;
    protected State $state;


    public function __construct(State $state)
    {
        $this->state = $state;
    }
    /**
     * @throws Exception
     */
    public function manage(): void
    {
        $this->processWorker()->handle();
    }

    public function produceResources($resourcesToProduce): array
    {
        $producedResources = [];
        foreach ($resourcesToProduce as $resource) {
            for ($i = 1; $i <= $this->getProductPerPeriod(); $i++) {
                /** @var IResource $resource */
                $producedResources[] = new $resource();
                //$resource->setProducer($this);
            }
        }
        return $producedResources;
    }

    public function processWorker(): Work|Rest|Heal
    {
        if ($this->getCurrentPlace() instanceof IHeal) {
            return new Heal($this->state);
        }

        if ($this->getCurrentPlace() instanceof IRest) {
            return new Rest($this->state);
        }

        return new Work($this->state);
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

    public function getCurrentPlace(): object
    {
        return $this->currentPlace;
    }

    public function setCurrentPlace($currentPlace): void
    {
        $this->currentPlace = $currentPlace;
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

    protected function processEnergy(): int
    {
        $result = $this->currentEnergy - 10;
        return $this->currentEnergy = $result;
    }

    /**
     * @throws Exception
     */
    protected function processHunger(): void
    {

        if ($this->state->getStateResources()->countItemsOfType('Farming') > 0) {
            $this->useFood();
        } elseif ($this->hungerValue < 3) {
            $this->hungerValue += 1;
        }

    }

    /**
     * @throws Exception
     */
    protected function useFood(): void
    {
        $this->state->getStateResources()->removeItemsByType(1,'Farming');
    }

    protected function processExp(): void
    {
        if ($this->isWorking()) {
            $this->currentExp += 20;

            if ($this->currentExp >= $this->expToLvlUp) {
                $this->lvlUp();
            }

        }
    }

    protected function lvlUp(): void
    {
        $this->currentLevel += 1;
        $this->expToLvlUp += 100;
        $this->currentExp = 0;
        $this->productPerPeriod += 1;
    }

    protected function processHealthDamage(): void
    {
        if ($this->hungerValue === 3) {
            $this->currentHealth -= 10;
        }
    }

    protected function processHealing(): void
    {
        while ($this->currentHealth <= $this->maxHealth) {
            $this->currentHealth += 10;

            if ($this->maxHealth - $this->currentHealth < 10) {
                $this->currentHealth = $this->maxHealth;
                break;
            }

        }
    }

    protected function processResting(): void
    {
        if ($this->currentEnergy <= $this->maxEnergy) {
            $this->currentEnergy += 10;
        }
    }

}