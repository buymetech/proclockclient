<?php


namespace BuyMe\ProcLockClient;


class LockFactory
{
    protected $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function create(string $resource)
    {
        return new Lock($resource, $this->url);
    }
}