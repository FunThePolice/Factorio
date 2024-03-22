<?php

namespace App\State;

use App\MainManager\MainManager;
use App\UtilityPlace\Contracts\IHeal;
use App\UtilityPlace\Contracts\IUtility;
use App\Workers\Contracts\IWorker;
use App\WorkPlace\Contracts\IWorkPlace;

class State
{

    protected StateResources $stateResources;
    protected MainManager $manager;


    public function __construct(StateResources $stateResources,MainManager $manager)
    {
        $this->stateResources = $stateResources;
        $this->setStateResources(new StateResources());
        $this->manager = $manager;
    }

    /**
     * @param StateResources $stateResources
     * @return State
     */
    public  function setStateResources(StateResources $stateResources): State
    {
        $this->stateResources = $stateResources;
        return $this;
    }

    /**
     * @return StateResources
     */
    public function getStateResources(): StateResources
    {
        return $this->stateResources;
    }

    public function moveWorkerToInfirmary(IWorker $worker): void
    {
        $this->manager->moveFromWorkToHeal($worker);
    }

    public function moveWorkerToWork(IWorker $worker): void
    {
        $this->manager->moveToWork($worker);
    }

    public function moveWorkerToRestRoom(IWorker $worker): void
    {
        $this->manager->moveFromWorkToRest($worker);
    }

}