<?php

namespace LKSS\Console\Commands;

use LKSS\StorageTree;

class ExitCommand implements Command
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        exit(0);
    }
}
