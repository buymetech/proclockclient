<?php
if (file_exists("../vendor/autoload.php"))
    require "../vendor/autoload.php";
elseif (file_exists("../../../autoload.php"))
    require "../../../autoload.php";
else exit('Exiting: no autoload.php found.');

$factory = new \BuyMe\ProcLockClient\LockFactory('tcp://127.0.0.1:30100');

$lock = $factory->create('my_res');

echo "locking\n";
$lock->lock();
echo "got a lock\n";
sleep(5);
$lock->unlock();
echo "unlocked\n";
