<?php

namespace App\Resources;

use App\Workers\BaseWorker;
use App\Workers\Contracts\IWorker;
use App\Resources\Contracts\IResource;

abstract class BaseResource implements IResource
{
    protected string $name;
    protected int $value;
    protected string $type;
    protected IWorker $producer;

    public function getName(): string
    {
        return $this->name ?? (new \ReflectionClass($this))->getShortName();
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getProducer(): object
    {
        return $this->producer;
    }

    public function setProducer($producer): void
    {
        $this->producer = $producer;
    }

}