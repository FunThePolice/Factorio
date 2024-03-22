<?php

use App\MainManager\MainManager;
use App\State\State;
use App\State\StateResources;
use App\Timer\Timer;

require __DIR__.'/../vendor/autoload.php';

$manager = new MainManager();
$state = new State(new StateResources(),$manager);
$timer = new Timer($manager,$state);

$timer->start();
