<?php

namespace App\WorkPlace;

use App\State\State;
use App\WorkPlace\Contracts\IWorkPlace;

class WorkPlaceFactory
{
    protected State $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }
    public function createWorkPlace(string $type,string $name): IWorkPlace
    {
        /** @var IWorkPlace $workPlace */
        $workPlace = new $type($this->state);
        $workPlace->setName($name);

        return $workPlace;
    }

}