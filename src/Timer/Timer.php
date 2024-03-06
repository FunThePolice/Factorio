<?php

namespace App\Timer;

use App\Workers\Workers\Farmer;
use App\Workers\Workers\Manufacturer;
use App\Workers\Workers\Miner;
use App\Workers\Workers\Processor;
use App\Workers\WorkersFactory;
use App\MainManager\MainManager;
use App\Resources\MineResources\Iron;
use App\State\State;
use App\WorkPlace\Farming\CornFarm;
use App\WorkPlace\Manufacturing\AssambleyShop;
use App\WorkPlace\Mining\IronMine;
use App\WorkPlace\Processing\MeltingSite;
use App\WorkPlace\WorkPlaceFactory;

class Timer
{
    protected MainManager $mainManager;

    protected State $state;

    const TICK_INTERVAL = 3;


    public function __construct(MainManager $mainManager,State $state)
    {
        $this->state = $state;
        $this->mainManager = $mainManager;
    }

    function runIt(): void
    { // Your function to run every 5 seconds
        $this->mainManager->manageAll();
    }

    function start(): void
    {
        $active = true;
        $nextTime = microtime(true) + static::TICK_INTERVAL; // Set initial delay

        $workersFactory = new WorkersFactory();
        $workPlaceFactory = new WorkPlaceFactory();
        $worker1 = $workersFactory->createWorker(Miner::class,$this->state,'Fucker');
        $workPlace1 = $workPlaceFactory->createWorkPlace(IronMine::class,$this->state,'CockFarm');

        $this->mainManager->addWorker($worker1);
        $this->mainManager->addWorkplace($workPlace1);

        $workPlace1->addWorker($worker1);

        //$this->state->getStateResources()->addItems([new Iron(),new Iron()]);

        while($active) {
            usleep(1000); // optional, if you want to be considerate

            if (microtime(true) >= $nextTime) {
                $this->runIt();
                $nextTime = microtime(true) + static::TICK_INTERVAL;
            }

            // Do other stuff (you can have as many other timers as you want)
        }
    }

}