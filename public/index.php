<?php

use App\MainManager\MainManager;
use App\State\State;
use App\State\StateResources;
use App\Timer\Timer;

require __DIR__.'/../vendor/autoload.php';

$state = new State(new StateResources());

$manager = new MainManager($state);
$timer = new Timer($manager,$state);

$timer->start();
