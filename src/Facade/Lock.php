<?php


namespace BuyMe\ProcLockClient\Facade;


use Illuminate\Support\Facades\Facade;

/**
 * Class Lock
 * @method static \BuyMe\ProcLockClient\Lock create(string $resource)
 */
class Lock extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'proc-lock';
    }
}
