<?php

namespace App\Timer;

use App\Entities\Workers\Miner;
use App\Entities\Workers\Processor;
use App\Entities\WorkersFactory;
use App\MainManager\MainManager;
use App\Resources\MineResources\Iron;
use App\State\State;
use App\State\StateStorage\Parts\PartsStorage;
use App\State\StateStorage\Parts\StatePartsItems;
use App\State\StateStorage\RawMaterials\IronStorage;
use App\State\StateStorage\RawMaterials\StateMineResources;
use App\WorkPlace\Mining\IronMine;
use App\WorkPlace\Processing\MeltingSite;
use App\WorkPlace\WorkPlaceFactory;

class Timer
{
    protected MainManager $mainManager;

    protected State $state;
    const INTERVAL = 2; // 5 seconds


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
        $nextTime = microtime(true) + INTERVAL; // Set initial delay

        $this->state->setStateMineResources(new StateMineResources());
        $this->state->setStatePartsItems(new StatePartsItems());
        $workersFactory = new WorkersFactory();
        $workPlaceFactory = new WorkPlaceFactory($this->state);
        $worker1 = $workersFactory->createWorker(Miner::class,$this->state,'Fucker');
        $workPlace1 = $workPlaceFactory->createWorkPlace(IronMine::class,$this->state,'CockFarm');
        $worker2 = $workersFactory->createWorker(Processor::class,$this->state, 'Fucker2');
        $workPlace2 = $workPlaceFactory->createWorkPlace(MeltingSite::class,$this->state, 'CockFarm2');
        $this->state->getStateMineResources()->setIronStorage(new IronStorage());
        $this->state->getStatePartsItems()->setParts(new PartsStorage());
        $this->mainManager->addEntity($worker1);
        $this->mainManager->addEntity($worker2);
        $this->mainManager->addWorkplace($workPlace1);
        $this->mainManager->addWorkplace($workPlace2);
        $this->mainManager->addEntityToWorkplace($worker1,$workPlace1);
        $this->mainManager->addEntityToWorkplace($worker2,$workPlace2);
        $this->state->getStateMineResources()->getIronStorage()->addIronToStorage(new Iron());
       // var_dump($this->state->getStateMineResources()->getIron()->getIronItems());

        //var_dump($workPlace2->getAllWorkers());
        //var_dump($this->mainManager->getWorkers());
        //var_dump($this->state);
        //var_dump($this->state->getStateMineResources());

        while($active) {
            usleep(1000); // optional, if you want to be considerate

            if (microtime(true) >= $nextTime) {
                $this->runIt();
                $nextTime = microtime(true) + INTERVAL;
            }

            // Do other stuff (you can have as many other timers as you want)
        }
    }

}