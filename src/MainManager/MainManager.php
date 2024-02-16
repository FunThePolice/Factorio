<?php

namespace App\MainManager;

use App\Entities\Contracts\IEntity;
use App\Entities\Contracts\IWorker;
use App\State\State;
use App\WorkPlace\BaseWorkPlace;
use App\WorkPlace\Contracts\IWorkPlace;

class MainManager
{
    protected array $workers;
    protected array $workPlaces;

    protected State $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function getWorkers(): array
    {
        return $this->workers;
    }

    public function getWorkPlaces(): array
    {
        return $this->workPlaces;
    }

    public function manageAll(): void
    {
        $this->manageWorkPlaces();
        dump($this->state->getStateResources()->getStorageValue());
    }
    public function addEntity(IWorker $worker): void
    {
        $this->workers[] = $worker;
    }
    public function addWorkplace(IWorkplace $workPlace): void
    {
        $this->workPlaces[] = $workPlace;
    }

    public function manageWorkers(): void
    {

    }

    public function manageWorkPlaces(): void
    {
        foreach ($this->workPlaces as $workplace) {
            $workplace->manage();

//            if ($workplace->isEmpty()) {
//                $this->removeEntitiesFromWorkplace($workplace);
//           }
        }
    }

}