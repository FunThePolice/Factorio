<?php

namespace App\WorkPlace\Manufacturing;

use App\Resources\FinalProducts\Cars;
use App\Resources\PartsItems\Parts;
use App\WorkPlace\BaseWorkPlace;
use App\WorkPlace\Contracts\IRecycle;

class AssambleyShop extends BaseWorkPlace implements IRecycle
{
    protected int $maxResources = 2000;
    protected int $currentResources = 0;
    protected int $workersCapacity = 5;
    protected string $typeOfProduct = 'Cars';
    protected string $occupation = 'Manufacturing';
    protected array $resourcesToProduce = [Cars::class];
    protected array $resourcesRequired = [Parts::class];

}