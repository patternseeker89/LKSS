<?php

namespace LKSS\Console\Commands;

use LKSS\StorageTree;
use LKSS\Console\Commands\Command;

class CloneNodeCommand implements Command
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $paramsString = substr($command, strlen(Command::CLONE_NODE) + 1);
        $params = explode(' ', $paramsString);
        if (count($params) == 2) {
            $nodeKey = ($params[0] == "null") ? null : $params[0];
            $targetNodeKey = $params[1];
            $this->storage->cloneNode($nodeKey, $targetNodeKey);
        } else {
            echo "Dont valid params!\n";
        }
    }
}
