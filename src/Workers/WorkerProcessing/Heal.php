<?php

namespace App\Workers\WorkerProcessing;

use App\Workers\BaseWorker;
use Exception;

class Heal extends BaseWorker
{
    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->processHealing();

        $this->processResting();
    }
}