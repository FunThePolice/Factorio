<?php

namespace App\State\StateStorage\RawMaterials;

use App\Resources\MineResources\Iron;
use App\State\StateObjects;

class StateMineResources extends StateObjects
{
    protected IronStorage $ironStorage;
    protected array $items = [];

    public function addItem($item): void
    {
        $this->items[] = $item;
    }
    public function getItems(): array
    {
        return $this->items;
    }

    public function getIronStorage(): IronStorage
    {
        return $this->ironStorage;
    }

    public  function setIronStorage(IronStorage $ironStorage): StateMineResources
    {
        $this->ironStorage = $ironStorage;
        return $this;
    }
    public function distribute($item): void
    {
        if ($item instanceof Iron){
            $this->ironStorage->addIronToStorage($item);
        }

    }
}