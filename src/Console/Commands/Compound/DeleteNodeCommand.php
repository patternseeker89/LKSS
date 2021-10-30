<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\StorageTree;
use LKSS\Console\Commands\Interfaces\CompoundCommand;

class DeleteNodeCommand implements CompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $nodeKey = substr($command, strlen(self::DELETE_NODE) + 1);
        $this->storage->deleteNode($nodeKey);
    }
}
