<?php

namespace LKSS\Network;

class Server implements ServerInterface
{
    private Socket $socket;

    public function __construct(Socket $socket)
    {
        error_reporting(E_ALL);

        /* Позволяет скрипту ожидать соединения бесконечно. */
        set_time_limit(180);

        /* Включает скрытое очищение вывода так, что мы видим данные
         * как только они появляются. */
        ob_implicit_flush();

        $this->socket = $socket;
    }

    public function start(): void
    {
        try {
            $this->socket->create();
            $this->socket->bind();
            $this->socket->listen();

            while(true) {
                $newClientSocket = $this->socket->accept();

                $message = "\nTest LKSS server! \n" . "Disconnect - exit. Server disable - close.\n";
                $this->socket->write($newClientSocket, $message);

                while (true) {
                    $stringBuffer = $this->socket->read($newClientSocket);
                    if (!$stringBuffer = trim($stringBuffer)) {
                        continue;
                    }
                    if ($stringBuffer == 'exit') {
                        break;
                    }
                    if ($stringBuffer == 'close') {
                        $this->socket->close($newClientSocket);
                        break 2;
                    }
                    $clientMessage = "Server: Вы сказали '$stringBuffer'.\n";
                    $this->socket->write($newClientSocket, $clientMessage);
                    echo "$stringBuffer\n";
                }
            }

            $this->socket->close();
        } catch (\Throwable $exception) {
            $this->socket->close();
            echo $exception->getMessage();
        }
    }
}