<?php

namespace App\Timer;

use App\UtilityPlace\Infirmary\Infirmary;
use App\UtilityPlace\RestRoom\RestRoom;
use App\UtilityPlace\UtilityFactory;
use App\Workers\Workers\Miner;
use App\Workers\WorkersFactory;
use App\MainManager\MainManager;
use App\State\State;
use App\WorkPlace\Mining\IronMine;
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

        $workersFactory = new WorkersFactory($this->state);
        $workPlaceFactory = new WorkPlaceFactory($this->state);
        $utilityFactory = new UtilityFactory();
        $infirmary = $utilityFactory->createUtilityPlace(Infirmary::class);
        $restRoom = $utilityFactory->createUtilityPlace(RestRoom::class);
        $worker1 = $workersFactory->createWorker(Miner::class,'Fucker');
        $workPlace1 = $workPlaceFactory->createWorkPlace(IronMine::class,'CockFarm');

        $this->mainManager->addWorker($worker1);
        $this->mainManager->addWorkplace($workPlace1);
        $this->mainManager->addUtility($infirmary);
        $this->mainManager->addUtility($restRoom);

        $workPlace1->addWorker($worker1);


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