<?php

namespace App\Workers\Workers;

use App\Workers\BaseWorker;

class Manufacturer extends BaseWorker
{
    protected string $occupation = 'Manufacturing';
    protected  int $productPerPeriod = 1;
    protected int $maxHealth = 100;
    protected int $currentHealth = 100;
    protected int $entityCost = 10;
    protected int $maxEnergy = 100;
    protected int $currentEnergy = 100;
    protected int $currentExp = 0;
    protected int $expToLvlUp = 200;
    protected int $currentLevel = 1;
}