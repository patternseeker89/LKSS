<?php

namespace LKSS\Console\Commands;

use LKSS\StorageTree;
use LKSS\Console\Commands\Command;

class MoveNodeCommand implements Command
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $paramsString = substr($command, strlen(Command::MOVE_NODE) + 1);
        $params = explode(' ', $paramsString);
        if (count($params) == 2) {
            $nodeKey = ($params[0] == "null") ? null : $params[0];
            $targetNodeKey = $params[1];
            $this->storage->moveNode($nodeKey, $targetNodeKey);
        } else {
            echo "Dont valid params!\n";
        }
    }
}
