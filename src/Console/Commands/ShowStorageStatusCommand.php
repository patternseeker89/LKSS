<?php

namespace LKSS\Console\Commands;

use LKSS\StorageTree;

class ShowStorageStatusCommand implements Command
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        echo "\n";
        if (!is_null($this->storage->getRoot())) {
            echo "nodes count: " . $this->storage->getCountOfNodes($this->storage->getRoot());
        }
        echo "\n";
    }
}
