<?php

namespace LKSS\Console\Commands;

use LKSS\StorageTree;
use LKSS\Console\ConsoleCommand;

class ShowNodeCommand implements Command
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $nodeKey = substr($command, strlen(ConsoleCommand::SHOW_NODE) + 1);
        $this->storage->showNode($nodeKey);
    }
}
