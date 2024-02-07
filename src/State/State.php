<?php

namespace App\State;

use App\State\StateStorage\Food\StateFoodResources;
use App\State\StateStorage\Parts\StatePartsItems;
use App\State\StateStorage\RawMaterials\StateMineResources;

class State
{
protected StateFoodResources $stateFoodResources;
protected StateMineResources $stateMineResources;
protected StatePartsItems $statePartsItems;

    /**
     * @param StateFoodResources $stateFoodResources
     * @return State
     */
    public function setStateFoodResources(StateFoodResources $stateFoodResources): State
    {
        $this->stateFoodResources = $stateFoodResources;
        return $this;
    }

    public function getStateFoodResources(): StateFoodResources
    {
        return $this->stateFoodResources;
    }

    public function setStateMineResources(StateMineResources $stateMineResources): State
    {
        $this->stateMineResources = $stateMineResources;
        return $this;
    }

    public function getStateMineResources(): StateMineResources
    {
        return $this->stateMineResources;
    }

    /**
     * @param StatePartsItems $statePartsItems
     * @return State
     */
    public function setStatePartsItems(StatePartsItems $statePartsItems): State
    {
        $this->statePartsItems = $statePartsItems;
        return $this;
    }

    /**
     * @return StatePartsItems
     */
    public function getStatePartsItems(): StatePartsItems
    {
        return $this->statePartsItems;
    }

}