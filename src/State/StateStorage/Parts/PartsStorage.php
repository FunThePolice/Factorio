<?php

namespace App\State\StateStorage\Parts;

class PartsStorage extends StatePartsItems
{
    protected array $storage = [];

    public function addPartsToStorage($item): void
    {
        $this->storage[] = $item;
    }

    public function removePartsItem(): void
    {
        array_shift($this->storage);
    }

    public function getStorage(): array
    {
        return $this->storage;
    }

}