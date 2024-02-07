<?php

use App\MainManager\MainManager;
use App\State\State;
use App\Timer\Timer;

require __DIR__.'/../vendor/autoload.php';
const INTERVAL = 3; // 5 seconds

$state = new State();

$manager = new MainManager($state);
$timer = new Timer($manager,$state);

$timer->start();
