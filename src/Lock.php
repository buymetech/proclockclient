<?php


namespace BuyMe\ProcLockClient;

use {ZMQ, ZMQSocket, ZMQContext};

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
        $this->socket = $ctx->getSocket(ZMQ::SOCKET_REQ, "client_socket");
        $this->socket->connect($url);
    }

    public function lock(): void
    {
        $this->socket->send("l$this->resource");
        $this->socket->recv();
    }

    public function unlock(): void
    {
        $this->socket->send("u$this->resource");
        $this->socket->recv();
    }
}