<?php

namespace App\Entities\Workers;

use App\Entities\BaseEntity;

class Farmer extends BaseEntity
{
    protected string $occupation = 'Farming';
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