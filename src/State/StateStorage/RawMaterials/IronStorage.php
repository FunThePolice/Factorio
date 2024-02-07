<?php

namespace App\State\StateStorage\RawMaterials;

class IronStorage extends StateMineResources
{
    protected array $storage = [];

    public function addIronToStorage($item): void
    {
        $this->ironStorage[] = $item;
    }

    public function removeIronFromStorage(): void
    {
        array_shift($this->storage);
    }

    public function getStorage(): array
    {
        return $this->storage;
    }
}