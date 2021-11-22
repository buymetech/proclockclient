<?php
if (file_exists("../vendor/autoload.php"))
    require "../vendor/autoload.php";
elseif (file_exists("../../../autoload.php"))
    require "../../../autoload.php";
else exit('Exiting: no autoload.php found.');

$id = pcntl_fork();
echo "$id\n";
if ($id === -1) {
    exit(1);
} else {
    process($id);
    pcntl_wait($ret);
}

function process($id) {
    $factory = new \BuyMe\ProcLockClient\LockFactory('tcp://127.0.0.1:30100');

    $lock = $factory->create('my_res');

    $now = getTime();
    echo "[$now] $id - locking\n";
    $lock->lock();
    $now = getTime();
    echo "[$now] $id - lock acquired\n";
    $to_sleep = random_int(2, 6);
    $now = getTime();
    echo "[$now] $id - sleeping for $to_sleep seconds\n";
    sleep($to_sleep);
    $now = getTime();
    echo "[$now] $id - unlocking\n";
    $lock->unlock();
    $lock->unlock();
}

function getTime() {
    $dt = new DateTime();
    return $dt->format('H:i:s.u');
}
