<?php

namespace App\Entities;

use App\Entities\Contract\IEntity;
use App\State\State;

class WorkersFactory
{

    public function createWorker(string $type,State $state,string $name): IEntity
    {
        /** @var IEntity $worker */
        $worker = new $type($state);
        $worker->setName($name);
        return $worker;
    }

}