<?php

namespace App\UtilityPlace;

use App\UtilityPlace\Contracts\IUtility;
use App\Workers\Contracts\IWorker;
use Exception;

abstract class BaseUtility implements IUtility
{
    protected string $occupation;
    protected int $workersCapacity;
    protected array $workersInUse;
    protected int $restorePerTick = 10;



    public function getWorkersCapacity(): int
    {
        return $this->workersCapacity;
    }

    public function getWorkersInUse(): array
    {
        return $this->workersInUse;
    }

    /**
     * @throws Exception
     */
    public function addWorker(IWorker $worker): void
    {

        if (count($this->workersInUse) >= $this->workersCapacity) {
            throw new Exception("Cannot add more workers");
        }

        $this->workersInUse[] = $worker;
        $worker->setIsWorking(false);
        $worker->setCurrentPlace($this);
    }

    public function removeWorker(int $id): void
    {
        unset($this->workersInUse[$id]);
    }

    public function getOccupation(): string
    {
        return $this->occupation;
    }

    public function getRestorePerTick(): int
    {
        return $this->restorePerTick;
    }

}