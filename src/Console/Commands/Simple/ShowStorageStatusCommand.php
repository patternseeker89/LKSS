<?php

namespace LKSS\Console\Commands\Simple;

use LKSS\Storage\StorageTree;
use LKSS\Console\Commands\Interfaces\SimpleCommand;

class ShowStorageStatusCommand implements SimpleCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(): void
    {
        echo "\n";
        if (!is_null($this->storage->getRoot())) {
            echo "nodes count: " . $this->storage->getCountOfNodes($this->storage->getRoot());
        }
        echo "\n";
    }
}
