<?php
require __DIR__ . '/vendor/autoload.php';

use SebastianBergmann\Timer\Timer;

$newtimer = new Timer;

$newtimer->start();

foreach (\range(0, 100000) as $i) {
    // ...
}

$scriptduration = $newtimer->stop();

var_dump($scriptduration->asSeconds());