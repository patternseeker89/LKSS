<?php

namespace LKSS\Network;

class Socket
{
    private string $address = '127.0.0.1';
    private int $port = 5000;
    private $socket;

    public function create(): void
    {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            throw new NetworkException("Не удалось выполнить socket_create(): причина: " . socket_strerror(socket_last_error()));
        }

        $this->socket = $socket;
    }

    public function bind(): void
    {
        if (socket_bind($this->socket, $this->address, $this->port) === false) {
            throw new NetworkException("Не удалось выполнить socket_bind(): причина: " . socket_strerror(socket_last_error($this->socket)));
        }
    }

    public function listen(): void
    {
        if (socket_listen($this->socket, 5) === false) {
            throw new NetworkException("Не удалось выполнить socket_listen(): причина: " . socket_strerror(socket_last_error($this->socket)));
        }
    }

    public function close($socket = null): void
    {
        if (is_null($socket)) {
            socket_close($this->socket);
        } else {
            socket_close($socket);
        }
    }

    /**
     * @return resource|\Socket
     * @throws NetworkException
     */
    public function accept()
    {
        $newClientSocket = socket_accept($this->socket);
        if ($newClientSocket === false) {
            throw new NetworkException("Не удалось выполнить socket_accept(): причина: " . socket_strerror(socket_last_error($this->socket)));
        }

        return $newClientSocket;
    }

    public function write($clientSocket, $message): void
    {
        socket_write($clientSocket, $message, strlen($message));
    }

    public function read($clientSocket): string
    {
        $stringBuffer = socket_read($clientSocket, 2048, PHP_NORMAL_READ);
        if (false === $stringBuffer) {
            throw new NetworkException("Не удалось выполнить socket_read(): причина: " . socket_strerror(socket_last_error($clientSocket)));
        }

        return $stringBuffer;
    }
}
