<?php

namespace App\WorkPlace\Mining;

use App\Resources\MineResources\Iron;
use App\WorkPlace\BaseWorkPlace;

class IronMine extends BaseWorkPlace
{
    protected int $maxResources = 2000;
    protected int $currentResources = 2000;
    protected int $workersCapacity = 5;
    protected string $typeOfProduct = 'Iron';
    protected string $occupation = 'Mining';
    protected array $resourcesToProduce = [Iron::class];

}