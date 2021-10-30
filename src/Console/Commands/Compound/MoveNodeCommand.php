<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\StorageTree;
use LKSS\Console\Commands\Interfaces\CompoundCommand;

class MoveNodeCommand implements CompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $paramsString = substr($command, strlen(self::MOVE_NODE) + 1);
        $params = explode(' ', $paramsString);
        if (count($params) == 2) {
            $commandHandler = new \LKSS\Console\Commands\CommandHandler();
            $nodeKeyParam = $commandHandler->getFirstParam($command, self::MOVE_NODE);
            $nodeKey = ($nodeKeyParam == "null") ? null : $nodeKeyParam;
            $targetNodeKey = $commandHandler->getSecondParam($command, self::MOVE_NODE);
            $this->storage->moveNode($nodeKey, $targetNodeKey);
        } else {
            echo "Dont valid params!\n";
        }
    }
}
