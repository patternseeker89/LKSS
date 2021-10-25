<?php

namespace LKSS\Console;

use LKSS\Console\Commands\InsertNodeCommand;
use LKSS\Console\Commands\ShowNodeCommand;
use LKSS\Console\Commands\ShowTreeCommand;

class Console 
{
    private InsertNodeCommand $insertNodeCommand;
    private ShowNodeCommand $showNodeCommand;
    private ShowTreeCommand $showTreeCommand;

    public function __construct(
        InsertNodeCommand $insertNodeCommand,
        ShowNodeCommand $showNodeComman,
        ShowTreeCommand $showTreeCommand
    ) {
        $this->insertNodeCommand = $insertNodeCommand;
        $this->showNodeCommand = $showNodeComman;
        $this->showTreeCommand = $showTreeCommand;
    }
    
    public function bash(): void
    {
        while (true) {
            $command = readline("> ");

            switch ($command) {
                case ConsoleCommand::EXIT:
                    exit(0);
                    break;
                case ConsoleCommand::SHOW_TREE:
                    $this->showTreeCommand->execute($command);
                    break;
                default:
                   $this->handleCommand($command);
            }
        }
    }

    public function handleCommand(string $command): void
    {
        switch ($command) {
            case substr($command, 0, strlen(ConsoleCommand::SHOW_NODE)) == ConsoleCommand::SHOW_NODE:
                $this->showNodeCommand->execute($command);
                break;
            case substr($command, 0, strlen(ConsoleCommand::INSERT_NODE)) == ConsoleCommand::INSERT_NODE:
                $this->insertNodeCommand->execute($command);
                break;
            default:
               echo $command . "\n";
        }
    }
}
