<?php

namespace App\State;

use App\WorkPlace\BaseWorkPlace;
use App\WorkPlace\Contract\IWorkPlace;

class StateWorkPlaces extends StateObjects

{
    protected IWorkPlace $workPlace;

    /** @var IWorkplace[] $workPlacesPool */
    protected array $workPlacesPool;

    public function createWorkPlace(string $type): void
    {
        /** @var IWorkPlace $workPlace */
        $workPlace = new $type();
        $this->workPlacesPool[] = $workPlace;

    }

    public function getWorkPlacesList(): array
    {
        return $this->workPlacesPool;
    }


}