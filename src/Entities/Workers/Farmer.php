<?php

namespace App\Entities\Workers;

use App\Entities\BaseWorker;

class Farmer extends BaseWorker
{
    protected string $occupation = 'Farming';
    protected  int $productPerPeriod = 2;
    protected int $maxHealth = 100;
    protected int $currentHealth = 100;
    protected int $entityCost = 10;
    protected int $maxEnergy = 100;
    protected int $currentEnergy = 100;
    protected int $currentExp = 0;
    protected int $expToLvlUp = 200;
    protected int $currentLevel = 1;
}