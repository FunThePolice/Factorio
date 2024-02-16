<?php

namespace App\Resources\Contracts;

use App\Entities\BaseWorker;
use App\Entities\Contracts\IWorker;

interface IResource
{
    public function getName(): string;
    public function getValue(): int;
    public function setProducer(BaseWorker $producer): void;
    public function getType(): string;
}