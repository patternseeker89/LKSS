<?php

namespace LKSS\Console;

use LKSS\Console\Commands\Command;
use LKSS\Console\CommandFactory;

class Console
{
    private CommandFactory $commandFactory;

    public function __construct(CommandFactory $consoleFactory)
    {
        $this->commandFactory = $consoleFactory;
    }

    public function bash(): void
    {
        while (true) {
            $command = readline("> ");

            switch ($command) {
                case Command::EXIT:
                    $this->commandFactory->create(Command::EXIT)->execute($command);
                    break;
                case Command::SHOW_TREE:
                    $this->commandFactory->create(Command::SHOW_TREE)->execute($command);
                    break;
                case Command::SHOW_STORAGE_STATUS:
                    $this->commandFactory->create(Command::SHOW_STORAGE_STATUS)->execute($command);
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
                $this->commandFactory->create(Command::SHOW_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(Command::INSERT_NODE)) == Command::INSERT_NODE:
                $this->commandFactory->create(Command::INSERT_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(Command::DELETE_NODE)) == Command::DELETE_NODE:
                $this->commandFactory->create(Command::DELETE_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(Command::UPDATE_NODE)) == Command::UPDATE_NODE:
                $this->commandFactory->create(Command::UPDATE_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(Command::RENAME_NODE)) == Command::RENAME_NODE:
                $this->commandFactory->create(Command::RENAME_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(Command::MOVE_NODE)) == Command::MOVE_NODE:
                $this->commandFactory->create(Command::MOVE_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(Command::CLONE_NODE)) == Command::CLONE_NODE:
                $this->commandFactory->create(Command::CLONE_NODE)->execute($command);
                break;
            default:
               echo $command . "\n";
        }
    }
}
