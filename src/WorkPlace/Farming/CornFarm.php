<?php

namespace App\WorkPlace\Farming;

use App\Resources\FoodResources\Corn;
use App\WorkPlace\BaseWorkPlace;

class CornFarm extends BaseWorkPlace
{
    protected int $maxResources = 2000;
    protected int $currentResources = 2000;
    protected int $workersCapacity = 5;
    protected string $typeOfProduct = 'Corn';
    protected string $occupation = 'Farming';
    protected array $resourcesToProduce = [Corn::class];



}