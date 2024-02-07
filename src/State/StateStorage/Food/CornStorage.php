<?php

namespace App\State\StateStorage\Food;

class CornStorage extends StateFoodResources
{
    protected array $storage = [];

    public function addCornToStorage($item): void
    {
        $this->storage[] = $item;
    }

    public function getStorage(): array
    {
        return $this->storage;
    }

}