<?php

namespace LKSS\Console\Commands;

use LKSS\StorageTree;

class DeleteNodeCommand implements Command
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $nodeKey = substr($command, strlen(Command::DELETE_NODE) + 1);
        $this->storage->deleteNode($nodeKey);
    }
}
