<?php

namespace App\Resources\Contract;

use App\Entities\BaseEntity;

interface IResource
{
    public function getName(): string;
    public function getValue(): int;
    public function getParent() : BaseEntity;
}