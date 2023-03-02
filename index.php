<?php
require __DIR__.'/vendor/autoload.php';
use src\TimeToWordConverter;

$time = new TimeToWordConverter();

echo $time->convert(0,0);