<?php

namespace App\WorkPlace;

use App\Exceptions\WorkPlaces\CannotAddMoreWorkersException;
use App\Workers\Contracts\IWorker;
use App\Resources\Contracts\IResource;
use App\Resources\MineResources\Iron;
use App\State\State;
use App\WorkPlace\Contracts\IRecycle;
use App\WorkPlace\Contracts\IWorkPlace;
use App\WorkPlace\Processing\MeltingSite;
use Exception;

abstract class BaseWorkPlace implements IWorkPlace
{
    protected string $name;
    protected int $maxResources = 0;
    protected int $currentResources ;
    protected int $workersCapacity = 0;

    /** @var $workersInUse IWorker[] */
    protected array $workersInUse = [];
    protected string $typeOfProduct;
    protected string $occupation;
    protected array $resourcesToProduce;
    protected array $resourcesRequired;

    protected State $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function manage(): void
    {

        foreach ($this->workersInUse as $key => $worker) {

            if ($this instanceof IRecycle) {
                $this->currentResources = $this->getRequiredResourcesNumber();
            }

            if ($this->isEmpty()) {
                break;
            }

            if ($this->currentResources <= $worker->getProductPerPeriod()) {
                $worker->setProductPerPeriod($this->currentResources);
                $this->currentResources = 0;
                break;
            }

            $this->processWork($worker);

            //dump($this->state->getStateResources()->getStorageValue());
        }

    }

    public function processWork($worker): void
    {
        /** @var IWorker $worker */
        $gatheredResources = $worker->produceResources($this->resourcesToProduce);
        $this->state->getStateResources()->addItems($gatheredResources);

        if ($this instanceof IRecycle) {
            $this->useRequiredResource($worker->getProductPerPeriod());
        }

        $this->currentResources = $this->currentResources - count($gatheredResources);
    }

    /**
     * @throws Exception
     */
    public function useRequiredResource(int $amount): void
    {
        foreach ($this->resourcesRequired as $resource) {
            /** @var IResource $resource */
            $var = new $resource();
            $this->state->getStateResources()->removeItemsByType($amount, $var->getType());
        }
    }

    public function getRequiredResourcesNumber(): int
    {
        $result = 0;
        foreach ($this->resourcesRequired as $resource) {
            /** @var IResource $resource */
            $var = new $resource();
            $result = $this->state->getStateResources()->countItemsOfType($var->getType());
            $result += $result;
        }
        return $result;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getMaxResources(): int
    {
        return $this->maxResources;
    }

    public function getCurrentResources(): int
    {
        return $this->currentResources;
    }

    public function setCurrentResources($value): void
    {
        $this->currentResources = $value;
    }

    public function getWorkersCapacity(): int
    {
        return $this->workersCapacity;
    }

    public function getAllWorkers(): array
    {
        return $this->workersInUse;
    }

    /**
     * @throws Exception
     */
    public function addWorker(IWorker $worker): void
    {

        if (count($this->workersInUse) >= $this->workersCapacity) {
            throw new CannotAddMoreWorkersException("Cannot add more workers");
        }

        $this->workersInUse[] = $worker;
        $worker->setIsWorking(true);
        $worker->setCurrentPlace($this);
        $worker->assignWorkPlace($this);
    }

    public function removeWorker(int $id): void
    {
        unset($this->workersInUse[$id]);
    }

    public function removeWorkers(): void
    {
        $this->workersInUse = [];
    }

    public function isEmpty(): bool
    {
        return $this->currentResources === 0;
    }

    /**
     * @throws \ReflectionException
     */
    public function getResource($typeOfProduct): void
    {
        $this->gatheredResources[(new \ReflectionClass($typeOfProduct))->getName()] = $typeOfProduct;
    }

    public function getOccupation(): string
    {
        return $this->occupation;
    }

    }