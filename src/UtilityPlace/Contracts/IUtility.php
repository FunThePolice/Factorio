<?php

namespace App\UtilityPlace\Contracts;

use App\Workers\Contracts\IWorker;

interface IUtility
{
    public function addWorker(IWorker $worker): void;
    public function removeWorker(int $id): void;

}