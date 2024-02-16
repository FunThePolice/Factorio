<?php

namespace App\Timer;

use App\Entities\Workers\Farmer;
use App\Entities\Workers\Manufacturer;
use App\Entities\Workers\Miner;
use App\Entities\Workers\Processor;
use App\Entities\WorkersFactory;
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
        $interval = 3;
        $nextTime = microtime(true) + $interval; // Set initial delay

        $workersFactory = new WorkersFactory();
        $workPlaceFactory = new WorkPlaceFactory();
        $worker1 = $workersFactory->createWorker(Miner::class,'Fucker');
        $worker2 = $workersFactory->createWorker(Processor::class, 'fuck');
        $worker3 = $workersFactory->createWorker(Manufacturer::class,'Ford');
        $workPlace1 = $workPlaceFactory->createWorkPlace(IronMine::class,$this->state,'CockFarm');
        $workPlace2 = $workPlaceFactory->createWorkPlace(MeltingSite::class,$this->state,'Melt');
        $workPlace3 = $workPlaceFactory->createWorkPlace(AssambleyShop::class,$this->state,'Ass');
        $this->mainManager->addEntity($worker1);
        $this->mainManager->addEntity($worker2);
        $this->mainManager->addEntity($worker3);
        $this->mainManager->addWorkplace($workPlace1);
        $this->mainManager->addWorkplace($workPlace2);
        $this->mainManager->addWorkplace($workPlace3);
        $workPlace1->addWorker($worker1);
        $workPlace2->addWorker($worker2);
        $workPlace3->addWorker($worker3);
        //$this->state->getStateResources()->addItems([new Iron(),new Iron()]);

        while($active) {
            usleep(1000); // optional, if you want to be considerate

            if (microtime(true) >= $nextTime) {
                $this->runIt();
                $nextTime = microtime(true) + $interval;
            }

            // Do other stuff (you can have as many other timers as you want)
        }
    }

}