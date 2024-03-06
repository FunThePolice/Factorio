<?php

namespace App\MainManager;

use App\Workers\Contracts\IWorker;
use App\State\State;
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
        //$this->manageWorkPlaces();
        $this->manageWorkers();
        dump($this->workers);
    }
    public function addWorker(IWorker $worker): void
    {
        $this->workers[] = $worker;
    }
    public function addWorkplace(IWorkplace $workPlace): void
    {
        $this->workPlaces[] = $workPlace;
    }

    public function manageWorkers(): void
    {
        foreach ($this->workers as $worker) {
            /** @var IWorker $worker */
            $worker->manage();
        }
    }

    public function manageWorkPlaces(): void
    {
        foreach ($this->workPlaces as $workplace) {
            /** @var IWorkPlace $workplace */
            $workplace->manage();

//            if ($workplace->isEmpty()) {
//                $this->removeEntitiesFromWorkplace($workplace);
//           }
        }
    }

}