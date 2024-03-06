<?php

namespace App\Workers\WorkerProcessing;

use App\Workers\BaseWorker;
use Exception;

class Work extends BaseWorker
{
    /**
     * @throws Exception
     */
    public function handle(): void
    {

           $this->processEnergy();

           $this->processHunger();

           $this->processExp();

           $this->processHealthDamage();

        }

}