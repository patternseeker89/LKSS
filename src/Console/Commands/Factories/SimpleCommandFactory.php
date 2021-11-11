<?php

namespace LKSS\Console\Commands\Factories;

use LKSS\StorageTree;
use LKSS\Console\Commands\Interfaces\SimpleCommand;
use LKSS\Console\Commands\Simple\ExitCommand;
use LKSS\Console\Commands\Simple\ShowTreeCommand;
use LKSS\Console\Commands\Simple\ShowStorageStatusCommand;

class SimpleCommandFactory implements CommandFactory
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @throws Exception
     */
    public function create(string $type): SimpleCommand
    {
        switch ($type) {
            case SimpleCommand::SHOW_TREE: return new ShowTreeCommand($this->storage);
            case SimpleCommand::SHOW_STORAGE_STATUS: return new ShowStorageStatusCommand($this->storage);
            case SimpleCommand::EXIT: return new ExitCommand($this->storage);
            default:
                throw new Exception('Wrong simple command type passed.');
        }

    }
}
