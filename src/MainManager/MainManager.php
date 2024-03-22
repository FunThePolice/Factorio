<?php

namespace App\MainManager;

use App\UtilityPlace\Contracts\IHeal;
use App\UtilityPlace\Contracts\IRest;
use App\UtilityPlace\Contracts\IUtility;
use App\Workers\Contracts\IWorker;
use App\WorkPlace\Contracts\IWorkPlace;

class MainManager
{
    protected array $workers;
    protected array $workPlaces;
    protected array $utilities;


    public function __construct()
    {

    }

    public function getWorkers(): array
    {
        return $this->workers;
    }

    public function getWorkPlaces(): array
    {
        return $this->workPlaces;
    }

    public function getUtilities(): array
    {
        return $this->utilities;
    }

    public function manageAll(): void
    {
        $this->manageWorkPlaces();
        $this->manageWorkers();
    }
    public function addWorker(IWorker $worker): void
    {
        $this->workers[] = $worker;
    }
    public function addWorkplace(IWorkplace $workPlace): void
    {
        $this->workPlaces[] = $workPlace;
    }
    public function addUtility(IUtility $utility): void
    {
        $this->utilities[] = $utility;
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


    public function moveFromWorkToHeal(IWorker $worker): void
    {
        $this->removeWorkerFromCurrentPlace($worker);
        $this->addWorkerToInfirmary($worker);
    }

    public function moveToWork(IWorker $worker): void
    {
        $this->removeWorkerFromCurrentPlace($worker);
        $this->addWorkerToWork($worker);
    }

    public function moveFromWorkToRest(IWorker $worker): void
    {
        $this->removeWorkerFromCurrentPlace($worker);
        $this->addWorkerToRestRoom($worker);
    }
    public function addWorkerToInfirmary(IWorker $worker): void
    {
        foreach ($this->getUtilities() as $utility) {
            if ($utility instanceof IHeal) {
                /** @var IUtility $utility */
                $utility->addWorker($worker);
            }
        }
    }

    public function addWorkerToRestRoom(IWorker $worker): void
    {
        foreach ($this->getUtilities() as $utility) {
            if ($utility instanceof IRest) {
                /** @var IUtility $utility */
                $utility->addWorker($worker);
            }
        }
    }

    public function addWorkerToWork(IWorker $worker): void
    {
        $workPlace = $worker->getAssignedWorkPlace();
        $workPlace->addWorker($worker);
    }

    public function removeWorkerFromCurrentPlace(IWorker $worker): void
    {
        $id = array_search($worker,$this->getWorkers());
        $currentPlace = $worker->getCurrentPlace();
        /** @var IWorkPlace|IUtility $currentPlace */
        $currentPlace->removeWorker($id);
    }

}