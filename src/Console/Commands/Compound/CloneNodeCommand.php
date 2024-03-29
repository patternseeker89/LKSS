<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\StorageTree;
use LKSS\Console\Commands\Interfaces\CompoundCommand;

class CloneNodeCommand implements CompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $paramsString = substr($command, strlen(self::CLONE_NODE) + 1);
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
