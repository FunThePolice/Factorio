<?php

namespace App\Workers;

use App\Workers\Contracts\IWorker;
use App\State\State;

class WorkersFactory
{

    public function createWorker(string $type,State $state,string $name): IWorker
    {
        /** @var IWorker $worker */
        $worker = new $type($state);
        $worker->setName($name);
        return $worker;
    }

}