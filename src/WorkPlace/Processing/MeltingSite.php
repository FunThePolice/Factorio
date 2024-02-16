<?php

namespace App\WorkPlace\Processing;

use App\Resources\MineResources\Iron;
use App\Resources\PartsItems\Parts;
use App\WorkPlace\BaseWorkPlace;
use App\WorkPlace\Contracts\IRecycle;

class MeltingSite extends BaseWorkPlace implements IRecycle
{
    protected int $maxResources = 2000;
    protected int $currentResources = 0;
    protected int $workersCapacity = 5;
    protected string $typeOfProduct = 'Parts';
    protected string $occupation = 'Processing';
    protected array $resourcesToProduce = [Parts::class];
    protected array $resourcesRequired = [Iron::class];

}