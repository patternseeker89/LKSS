<?php

namespace LKSS\Console;

use LKSS\Console\Commands\InsertNodeCommand;
use LKSS\Console\Commands\Command;
use LKSS\Console\Commands\DeleteNodeCommand;
use LKSS\Console\Commands\UpdateNodeCommand;
use LKSS\Console\Commands\RenameNodeCommand;
use LKSS\Console\Commands\MoveNodeCommand;
use LKSS\Console\Commands\ShowStorageStatusCommand;
use LKSS\Console\ConsoleFactory;

class Console
{
    private InsertNodeCommand $insertNodeCommand;
    private DeleteNodeCommand $deleteNodeCommand;
    private UpdateNodeCommand $updateNodeCommand;
    private RenameNodeCommand $renameNodeCommand;
    private MoveNodeCommand $moveNodeCommand;
    private ShowStorageStatusCommand $showStorageStatusCommand;
    private ConsoleFactory $consoleFactory;

    public function __construct(
        InsertNodeCommand $insertNodeCommand,
        DeleteNodeCommand $deleteNodeCommand,
        UpdateNodeCommand $updateNodeCommand,
        RenameNodeCommand $renameNodeCommand,
        MoveNodeCommand $moveNodeCommand,
        ShowStorageStatusCommand $showStorageStatusCommand,
        ConsoleFactory $consoleFactory
    ) {
        $this->insertNodeCommand = $insertNodeCommand;
        $this->deleteNodeCommand = $deleteNodeCommand;
        $this->updateNodeCommand = $updateNodeCommand;
        $this->renameNodeCommand = $renameNodeCommand;
        $this->moveNodeCommand = $moveNodeCommand;
        $this->showStorageStatusCommand =$showStorageStatusCommand;
        $this->consoleFactory = $consoleFactory;
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
                    $this->consoleFactory->create(Command::SHOW_TREE)->execute($command);
                    break;
                case Command::SHOW_STORAGE_STATUS:
                    $this->showStorageStatusCommand->execute($command);
                    break;
                default:
                   $this->handleCommandWithParams($command);
            }
        }
    }

    /**
     * 
     * USE SIMPLE FACTORY !!!!!!
     */
    
    public function handleCommandWithParams(string $command): void
    {
        switch ($command) {
            case substr($command, 0, strlen(Command::SHOW_NODE)) == Command::SHOW_NODE:
                $this->consoleFactory->create(Command::SHOW_NODE)->execute($command);
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
            case substr($command, 0, strlen(Command::RENAME_NODE)) == Command::RENAME_NODE:
                $this->renameNodeCommand->execute($command);
                break;
            case substr($command, 0, strlen(Command::MOVE_NODE)) == Command::MOVE_NODE:
                $this->moveNodeCommand->execute($command);
                break;
            default:
               echo $command . "\n";
        }
    }
}
