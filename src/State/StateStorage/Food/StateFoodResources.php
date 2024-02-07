<?php

namespace App\State\StateStorage\Food;

use App\Resources\FoodResources\Corn;
use App\State\StateObjects;

class StateFoodResources extends StateObjects
{
    protected CornStorage $cornStorage;
    protected array $items = [];


    public function addItem($item): void
    {
        $this->items[] = $item;
    }
    public function getItems(): array
    {
        return $this->items;
    }

    public function getCornStorage(): CornStorage
    {
        return $this->cornStorage;
    }

    public  function setCornStorage(CornStorage $cornStorage): StateFoodResources
    {
        $this->cornStorage = $cornStorage;
        return $this;
    }
    public function distribute($item): void
    {
            if ($item instanceof Corn){
                $this->cornStorage->addCornToStorage($item);
            }

    }

}