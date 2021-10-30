<?php

namespace LKSS\Console\Commands\Factories;

use LKSS\StorageTree;
use LKSS\Console\Commands\Factories\CommandFactory;
use LKSS\Console\Commands\Interfaces\CompoundCommand;
use LKSS\Console\Commands\Compound\ShowNodeCommand;
use LKSS\Console\Commands\Compound\InsertNodeCommand;
use LKSS\Console\Commands\Compound\DeleteNodeCommand;
use LKSS\Console\Commands\Compound\UpdateNodeCommand;
use LKSS\Console\Commands\Compound\RenameNodeCommand;
use LKSS\Console\Commands\Compound\MoveNodeCommand;
use LKSS\Console\Commands\Compound\CloneNodeCommand;

class CompoundCommandFactory implements CommandFactory
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @throws Exception
     */
    public function create(string $type): CompoundCommand
    {
        switch ($type) {
            case CompoundCommand::SHOW_NODE: return new ShowNodeCommand($this->storage);
            case CompoundCommand::INSERT_NODE: return new InsertNodeCommand($this->storage);
            case CompoundCommand::DELETE_NODE: return new DeleteNodeCommand($this->storage);
            case CompoundCommand::UPDATE_NODE: return new UpdateNodeCommand($this->storage);
            case CompoundCommand::RENAME_NODE: return new RenameNodeCommand($this->storage);
            case CompoundCommand::MOVE_NODE: return new MoveNodeCommand($this->storage);
            case CompoundCommand::CLONE_NODE: return new CloneNodeCommand($this->storage);
            default:
                throw new Exception('Wrong command type passed.');
        }

    }
}
