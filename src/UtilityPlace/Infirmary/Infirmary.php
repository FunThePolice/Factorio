<?php

namespace App\UtilityPlace\Infirmary;

use App\UtilityPlace\BaseUtility;
use App\UtilityPlace\Contracts\IHeal;

class Infirmary extends BaseUtility implements IHeal
{
    protected string $occupation = 'Healing';

}