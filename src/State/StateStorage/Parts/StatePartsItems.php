<?php

namespace App\State\StateStorage\Parts;

use App\Resources\PartsItems\Parts;
use App\State\StateObjects;

class StatePartsItems extends StateObjects
{

    protected PartsStorage $partsStorage;
    protected array $items = [];

    public function addItem($item): void
    {
        $this->items[] = $item;
    }
    public function getItems(): array
    {
        return $this->items;
    }

    public function getPartsStorage(): PartsStorage
    {
        return $this->partsStorage;
    }

    public  function setParts(PartsStorage $partsStorage): StatePartsItems
    {
        $this->partsStorage = $partsStorage;
        return $this;
    }
    public function distribute($item): void
    {
        if ($item instanceof Parts){
            $this->partsStorage->addPartsItem($item);
        }

    }

}