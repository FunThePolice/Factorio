<?php

namespace App\Workers\WorkerProcessing;

use App\State\State;
use App\Workers\BaseWorker;
use App\Workers\Contracts\IWorker;
use Exception;

class Rest
{
    protected IWorker $worker;
    protected State $state;

    public function __construct(State $state, IWorker $worker)
    {
        $this->state = $state;
        $this->worker = $worker;
    }

    public function handle(): void
    {
        $this->handleStatus();
        $this->handleRotation();
    }
    public function handleStatus(): void
    {
        $this->worker->processHunger();

        $this->worker->processResting();
    }

    public function handleRotation(): void
    {

        if ($this->worker->getCurrentEnergy() >= $this->worker->getMaxEnergy()) {
            $this->worker->setCurrentEnergy($this->worker->getMaxEnergy());
            $this->state->moveWorkerToWork($this->worker);
        }
    }

}