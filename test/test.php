<?php
require "../vendor/autoload.php";

$factory = new \BuyMe\ProcLockClient\LockFactory('tcp://127.0.0.1:30100');

$lock = $factory->create('my_res');

echo "locking\n";
$lock->lock();
echo "got a lock\n";
sleep(5);
$lock->unlock();
echo "unlocked\n";
