<?php

namespace App\UtilityPlace\RestRoom;

use App\UtilityPlace\BaseUtility;
use App\UtilityPlace\Contracts\IRest;

class RestRoom extends BaseUtility implements IRest
{
    protected string $occupation = 'Resting';

}