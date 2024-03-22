<?php

namespace App\State;

use App\Exceptions\State\NoResourceOfType;
use App\Resources\Contracts\IResource;
use Exception;

class StateResources
{

    protected IResource $resource;
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

    public function addItems(array $resources): void
    {
        foreach ($resources as $resource) {
            $this->storage[$resource->getType()][] = $resource;
        }
    }

    /**
     * @throws Exception
     */
    public function removeItemsByType(int $amount, string $type): void
    {

        if ($this->countItemsOfType($type) <= 0) {
            throw new NoResourceOfType();
        }

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