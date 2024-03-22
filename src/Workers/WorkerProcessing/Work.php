<?php

namespace App\Workers\WorkerProcessing;

use App\MainManager\MainManager;
use App\State\State;
use App\Workers\BaseWorker;
use App\Workers\Contracts\IWorker;
use Exception;

class Work
{
    protected IWorker $worker;
    protected State $state;

    public function __construct(State $state, IWorker $worker)
    {
        $this->state = $state;
        $this->worker = $worker;
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->handleStatus();
        $this->handleRotation();
    }

    /**
     * @throws Exception
     */
    public function handleStatus(): void
    {
        $this->worker->processEnergy();

        $this->worker->processHunger();

        $this->worker->processExp();

        $this->worker->processHealthDamage();
    }

    public function handleRotation(): void
    {

        if ($this->worker->getCurrentEnergy() <= $this->worker->getMaxEnergy() / 2) {
            $this->state->moveWorkerToRestRoom($this->worker);
        }

        if ($this->worker->getCurrentHealth() <= $this->worker->getMaxHealth() / 2) {
            $this->state->moveWorkerToInfirmary($this->worker);
        }

    }

}