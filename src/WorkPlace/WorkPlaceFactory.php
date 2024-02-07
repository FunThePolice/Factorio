<?php

namespace App\WorkPlace;

use App\State\State;
use App\WorkPlace\Contract\IWorkPlace;

class WorkPlaceFactory
{
    protected State $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }
    public function createWorkPlace(string $type,State $state,string $name): IWorkPlace
    {
        /** @var IWorkPlace $workPlace */
        $workPlace = new $type($state);
        $workPlace->setName($name);

        return $workPlace;
    }

}