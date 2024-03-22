<?php

namespace App\Workers;

use App\Workers\Contracts\IWorker;
use App\State\State;

class WorkersFactory
{
    protected State $state;
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function createWorker(string $type, string $name): IWorker
    {
        /** @var IWorker $worker */
        $worker = new $type($this->state);
        $worker->setName($name);
        return $worker;
    }

}