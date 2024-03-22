<?php

namespace App\Resources\Contracts;

use App\Workers\Contracts\IWorker;

interface IResource
{
    public function getName(): string;
    public function getValue(): int;
    public function setProducer(IWorker $producer): void;
    public function getType(): string;
}