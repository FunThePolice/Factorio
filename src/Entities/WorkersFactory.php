<?php

namespace App\Entities;

use App\Entities\Contracts\IWorker;
use App\State\State;

class WorkersFactory
{

    public function createWorker(string $type,string $name): IWorker
    {
        /** @var IWorker $worker */
        $worker = new $type();
        $worker->setName($name);
        return $worker;
    }

}