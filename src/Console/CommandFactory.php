<?php

namespace LKSS\Console;

use LKSS\StorageTree;
use LKSS\Console\Commands\Command;
use LKSS\Console\Commands\ExitCommand;
use LKSS\Console\Commands\ShowTreeCommand;
use LKSS\Console\Commands\ShowNodeCommand;
use LKSS\Console\Commands\InsertNodeCommand;
use LKSS\Console\Commands\DeleteNodeCommand;
use LKSS\Console\Commands\UpdateNodeCommand;
use LKSS\Console\Commands\RenameNodeCommand;
use LKSS\Console\Commands\MoveNodeCommand;
use LKSS\Console\Commands\ShowStorageStatusCommand;
use LKSS\Console\Commands\CloneNodeCommand;



/**
 * @TODO Split factory on two(simple and composit)
 */
class CommandFactory
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
            case Command::INSERT_NODE: return new InsertNodeCommand($this->storage);
            case Command::DELETE_NODE: return new DeleteNodeCommand($this->storage);
            case Command::UPDATE_NODE: return new UpdateNodeCommand($this->storage);
            case Command::RENAME_NODE: return new RenameNodeCommand($this->storage);
            case Command::MOVE_NODE: return new MoveNodeCommand($this->storage);
            case Command::SHOW_STORAGE_STATUS: return new ShowStorageStatusCommand($this->storage);
            case Command::CLONE_NODE: return new CloneNodeCommand($this->storage);
            case Command::EXIT: return new ExitCommand($this->storage);
            default:
                throw new Exception('Wrong command type passed.');
        }

    }
}
