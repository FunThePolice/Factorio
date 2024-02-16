<?php

namespace App\State;

class State
{

protected StateResources $stateResources;

    public function __construct(StateResources $stateResources)
    {
        $this->stateResources = $stateResources;
        $this->setStateResources(new StateResources());
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

}