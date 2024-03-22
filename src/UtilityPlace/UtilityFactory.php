<?php

namespace App\UtilityPlace;

use App\State\State;
use App\UtilityPlace\Contracts\IUtility;

class UtilityFactory
{

    public function __construct()
    {

    }
    public function createUtilityPlace(string $type): IUtility
    {
        /** @var IUtility $utilityPlace */
        $utilityPlace = new $type();
        return $utilityPlace;
    }

}