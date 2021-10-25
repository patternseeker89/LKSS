<?php

namespace LKSS\Console\Commands;

use LKSS\StorageTree;

class ShowTreeCommand implements Command
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        echo ".\n";
        echo "|\n";
        if (!is_null($this->storage->getRoot())) {
            $this->storage->printTree($this->storage->getRoot(), "|");
        }
        echo "\n";
    }
}
