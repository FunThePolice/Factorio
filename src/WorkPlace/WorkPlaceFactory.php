<?php

namespace App\WorkPlace;

use App\State\State;
use App\WorkPlace\Contracts\IWorkPlace;

class WorkPlaceFactory
{
    protected State $state;

    public function __construct()
    {

    }
    public function createWorkPlace(string $type,State $state,string $name): IWorkPlace
    {
        /** @var IWorkPlace $workPlace */
        $workPlace = new $type($state);
        $workPlace->setName($name);

        return $workPlace;
    }

}