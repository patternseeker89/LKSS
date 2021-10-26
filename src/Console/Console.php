<?php

namespace LKSS\Console;

use LKSS\Console\Commands\InsertNodeCommand;
use LKSS\Console\Commands\ShowNodeCommand;
use LKSS\Console\Commands\ShowTreeCommand;
use LKSS\Console\Commands\Command;
use LKSS\Console\Commands\DeleteNodeCommand;
use LKSS\Console\Commands\UpdateNodeCommand;

class Console
{
    private InsertNodeCommand $insertNodeCommand;
    private ShowNodeCommand $showNodeCommand;
    private ShowTreeCommand $showTreeCommand;
    private DeleteNodeCommand $deleteNodeCommand;
    private UpdateNodeCommand $updateNodeCommand;

    public function __construct(
        InsertNodeCommand $insertNodeCommand,
        ShowNodeCommand $showNodeComman,
        ShowTreeCommand $showTreeCommand,
        DeleteNodeCommand $deleteNodeCommand,
        UpdateNodeCommand $updateNodeCommand
    ) {
        $this->insertNodeCommand = $insertNodeCommand;
        $this->showNodeCommand = $showNodeComman;
        $this->showTreeCommand = $showTreeCommand;
        $this->deleteNodeCommand = $deleteNodeCommand;
        $this->updateNodeCommand = $updateNodeCommand;
    }
    
    public function bash(): void
    {
        while (true) {
            $command = readline("> ");

            switch ($command) {
                case Command::EXIT:
                    exit(0);
                    break;
                case Command::SHOW_TREE:
                    $this->showTreeCommand->execute($command);
                    break;
                default:
                   $this->handleCommandWithParams($command);
            }
        }
    }

    public function handleCommandWithParams(string $command): void
    {
        switch ($command) {
            case substr($command, 0, strlen(Command::SHOW_NODE)) == Command::SHOW_NODE:
                $this->showNodeCommand->execute($command);
                break;
            case substr($command, 0, strlen(Command::INSERT_NODE)) == Command::INSERT_NODE:
                $this->insertNodeCommand->execute($command);
                break;
            case substr($command, 0, strlen(Command::DELETE_NODE)) == Command::DELETE_NODE:
                $this->deleteNodeCommand->execute($command);
                break;
            case substr($command, 0, strlen(Command::UPDATE_NODE)) == Command::UPDATE_NODE:
                $this->updateNodeCommand->execute($command);
                break;
            default:
               echo $command . "\n";
        }
    }
}
