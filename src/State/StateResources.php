<?php

namespace App\State;

use App\Resources\BaseResource;
use App\Resources\Contracts\IResource;
use App\Resources\MineResources\Iron;

class StateResources
{

    protected BaseResource $resource;
    protected array $storage = [
        'Farming' => [],
        'Mining' => [],
        'Processing' => [],
        'Manufacturing' => []
    ];

    public function getStorage(): array
    {
        return $this->storage;
    }

    public function getStorageValue(): array
    {
        $result = [];
        foreach ($this->getStorage() as $type => $value) {
            $result[$type] = count($value);
        }
        return $result;
    }

    public function addItem(IResource $resource): void
    {
        $this->storage[$resource->getType()][] = $resource;
    }

    public function addItems(array $resources): void
    {
        foreach ($resources as $resource) {
            $this->addItem($resource);
        }
    }

    public function removeItemsByType(int $amount, string $type): void
    {
        array_splice($this->storage[$type],0,$amount);
    }

    public function getItemsByType(string $type): array
    {
         return $this->storage[$type];
    }

    public function countItemsOfType(string $type): int
    {
        return count($this->getItemsByType($type));
    }

}