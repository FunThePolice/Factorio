<?php

namespace App\WorkPlace\Contracts;

use App\Workers\Contracts\IWorker;

interface IWorkPlace
{
    public function getName(): string;
    public function getMaxResources(): int;
    public function getCurrentResources(): int;
    public function setCurrentResources($value): void;
    public function getWorkersCapacity(): int;
    public function getAllWorkers(): array;
    public function manage(): void;
    public function getOccupation(): string;
    public function setName(string $name): void;
    public function processWork($worker): void;
    public function addWorker(IWorker $worker): void;
    public function removeWorker(int $id): void;

}