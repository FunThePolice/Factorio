<?php

namespace App\WorkPlace;

use App\Entities\Contract\IEntity;
use App\Resources\Contract\IResource;
use App\Resources\MineResources\Iron;
use App\State\State;
use App\WorkPlace\Contract\IRecycle;
use App\WorkPlace\Contract\IWorkPlace;
use App\WorkPlace\Processing\MeltingSite;

abstract class BaseWorkPlace implements IWorkPlace
{
    protected string $name;
    protected int $maxResources = 0;
    protected int $currentResources = 0;
    protected int $workersCapacity = 0;

    /** @var $workersInUse IEntity[] */
    protected array $workersInUse = [];
    protected string $typeOfProduct;
    protected string $occupation;
    protected array $resourcesToProduce;
    protected array $resourcesRequired;
    protected array $gatheredPerTick;

    protected State $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function manage(): void
    {

        foreach ($this->workersInUse as $key => $worker) {

//            if ($this instanceof IRecycle) {
//                $this->currentResources = count($this->getRequiredResources());
//            }


//            if ($this->isEmpty()) {
//                break;
//            }

//            if ($this->workersInUse > $this->workersCapacity){
//                break;
//            }
//
//            if ($this->currentResources <= $worker->getProductPerPeriod()) {
//                $gatheredResources += $this->currentResources;
//                $this->currentResources = 0;
//                break;
//            }
                $this->processWork($worker);
            dump($this->resourcesRequired);
            }

    }

    public function processWork($worker): void
    {
        $gatheredResources = [];
            foreach ($this->resourcesToProduce as $resource) {
                while (count($gatheredResources) < $worker->getProductPerPeriod()) {
                    /** @var IResource $resource */
                    $gatheredResources[] = new $resource();

//                    if ($this instanceof IRecycle) {
//                        $this->useRequiredResource();
//                    }

                }
            }
            $this->distribute($gatheredResources);
            $this->currentResources = $this->currentResources - count($gatheredResources);
    }

    public function recycleWork($worker): void
    {
        $gatheredResources = [];

        foreach ($this->resourcesToProduce as $resource) {
            while (count($gatheredResources) < $worker->getProductPerPeriod()) {
                /** @var IResource $resource */
                $gatheredResources[] = new $resource();
                $this->useRequiredResource();
            }
        }
        $this->distribute($gatheredResources);
    }

    public function distribute($resources): void
    {
        foreach ($resources as $resource) {

            if ($this->occupation === 'Farming') {
                $this->state->getStateFoodResources()->addItem($resource);
                $this->state->getStateFoodResources()->distribute($resource);
                // var_dump($this->state->getStateFoodResources()->getCornState()->getCornStorage());
            }

            if ($this->occupation === 'Mining') {
                $this->state->getStateMineResources()->addItem($resource);
                $this->state->getStateMineResources()->distribute($resource);
                //var_dump($this->state->getStateMineResources()->getIron());
            }

            if ($this->occupation === 'Processing') {
                $this->state->getStatePartsItems()->addItem($resource);
                $this->state->getStatePartsItems()->distribute($resource);
                //var_dump($this->state->getStatePartsItems()->getParts());
            }

        }
    }

    public function useRequiredResource(): void
    {
        foreach ($this->resourcesRequired as $resource) {

            if ($resource instanceof Iron) {
                $this->state->getStateMineResources()->getIronStorage()->removeIronFromStorage();
            }

        }
    }

    public function getRequiredResources(): array
    {
        $resources = [];

        foreach ($this->resourcesRequired as $resource) {

            if ($resource instanceof Iron) {
                $resources = $this->state->getStateMineResources()->getIronStorage()->getStorage();
            }
        }
        return $resources;
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

    public function addWorker(IEntity $worker): void
    {
        $this->workersInUse[] = $worker;
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