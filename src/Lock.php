<?php


namespace BuyMe\ProcLockClient;

use ZMQ;
use ZMQSocket;
use ZMQContext;
use ZMQSocketException;

class Lock
{
    protected $resource;

    /**
     * @var ZMQSocket
     */
    protected $socket;

    public function __construct(string $resource, string $url)
    {
        $this->resource = $resource;
        $ctx = new ZMQContext();
        $this->socket = $ctx->getSocket(ZMQ::SOCKET_REQ);
        $this->socket->connect($url);
    }

    public function lock(): void
    {
        $this->socket->send("l$this->resource");
        $this->socket->recv();
    }

    public function unlock(): void
    {
        try {
            $this->socket->send("u$this->resource");
        }
        catch (ZMQSocketException $e) {
            //silence the double unlock call
            if (false === strpos($e->getMessage(), 'Operation cannot be accomplished in current state')) {
                throw $e;
            }
        }
    }
}
