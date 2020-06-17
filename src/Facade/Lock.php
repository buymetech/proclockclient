<?php


namespace BuyMe\ProcLockClient\Facade;


use Illuminate\Support\Facades\Facade;

class Lock extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'proc-lock';
    }
}