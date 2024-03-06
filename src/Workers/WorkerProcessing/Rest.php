<?php

namespace App\Workers\WorkerProcessing;

use App\Workers\BaseWorker;
use Exception;

class Rest extends BaseWorker
{
    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->processHunger();

        $this->processResting();
    }
}