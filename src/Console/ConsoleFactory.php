<?php

namespace LKSS\Console;

use LKSS\StorageTree;
use LKSS\Console\Commands\Command;
use LKSS\Console\Commands\ShowTreeCommand;
use LKSS\Console\Commands\ShowNodeCommand;

class ConsoleFactory
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @throws Exception
     */
    public function create(string $type): Command
    {
        switch ($type) {
            case Command::SHOW_TREE: return new ShowTreeCommand($this->storage);
            case Command::SHOW_NODE: return new ShowNodeCommand($this->storage);
            default:
                throw new Exception('Wrong command type passed.');
        }

    }
}
