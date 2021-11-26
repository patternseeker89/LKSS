<?php

namespace LKSS\Console\Commands\Simple;

use LKSS\Storage\StorageTree;
use LKSS\Console\Commands\Interfaces\SimpleCommand;

class ExitCommand implements SimpleCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(): void
    {
        exit(0);
    }
}
