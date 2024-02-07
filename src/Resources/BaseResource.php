<?php

namespace App\Resources;

use App\Entities\BaseEntity;
use App\Resources\Contract\IResource;

abstract class BaseResource implements IResource
{
    protected string $name;
    protected int $value;
    protected string $type;
    protected BaseEntity $parent;

    public function getName(): string
    {
        return $this->name ?? (new \ReflectionClass($this))->getShortName();
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getParent(): BaseEntity
    {
        return $this->parent;
    }

}