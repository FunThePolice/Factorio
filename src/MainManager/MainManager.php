<?php

namespace App\MainManager;

use App\Entities\Contract\IEntity;
use App\State\State;
use App\WorkPlace\BaseWorkPlace;
use App\WorkPlace\Contract\IWorkPlace;

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
    }
    public function addEntity(IEntity $worker): void
    {
        $this->workers[] = $worker;
    }
    public function addWorkplace(IWorkplace $workPlace): void
    {
        $this->workPlaces[] = $workPlace;
    }

    public function addEntityToWorkplace(IEntity $worker,IWorkplace $workplace): void
    {
        /** @var IEntity $entity */
        foreach ($this->workers as $key => $entity) {
            if ($entity->getName() === $worker->getName()) {
                $entity->setIsWorking(true);
                $workplace->addWorker($entity);
            }

            }
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