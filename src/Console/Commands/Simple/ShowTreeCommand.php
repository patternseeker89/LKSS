<?php

namespace LKSS\Console\Commands\Simple;

use LKSS\Storage\StorageTree;
use LKSS\Console\Commands\Interfaces\SimpleCommand;

class ShowTreeCommand implements SimpleCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(): void
    {
        echo ".\n";
        echo "|\n";
        if (!is_null($this->storage->getRoot())) {
            $this->storage->printTree($this->storage->getRoot(), "|");
        }
        echo "\n";
    }
}
