<?php

namespace LKSS\Console;

use LKSS\Console\Commands\Interfaces\SimpleCommand;
use LKSS\Console\Commands\Interfaces\CompoundCommand;
use LKSS\Console\Commands\Factories\SimpleCommandFactory;
use LKSS\Console\Commands\Factories\CompoundCommandFactory;

class Console
{
    private SimpleCommandFactory $simpleCommandFactory;
    private CompoundCommandFactory $compoundCommandFactory;

    public function __construct(
        SimpleCommandFactory $simpleCommandFactory,
        CompoundCommandFactory $compoundCommandFactory
    ) {
        $this->simpleCommandFactory = $simpleCommandFactory;
        $this->compoundCommandFactory = $compoundCommandFactory;

        //@TODO make object with params from console(user) like Request in Laravel
        //@TODO maybe make trait with validation for Command classes
    }

    public function bash(): void
    {
        while (true) {
            /**
             * TODO normal text input from terminal
             * $command = readline("> ");
             * echo "\033[1mbold\n";die();
             * echo "\033[1mbold\033[31m some colored text \e[90mDark gray fgrtggr\n";die();
             * https://misc.flogisoft.com/bash/tip_colors_and_formatting
             * https://unix.stackexchange.com/questions/37260/change-font-in-echo-command
             */
            echo "> ";
            $command = stream_get_line(STDIN, 999999, "\n");

            switch ($command) {
                case SimpleCommand::EXIT:
                    $this->simpleCommandFactory->create(SimpleCommand::EXIT)->execute();
                    break;
                case SimpleCommand::SHOW_TREE:
                    $this->simpleCommandFactory->create(SimpleCommand::SHOW_TREE)->execute();
                    break;
                case SimpleCommand::SHOW_STORAGE_STATUS:
                    $this->simpleCommandFactory->create(SimpleCommand::SHOW_STORAGE_STATUS)->execute();
                    break;
                default:
                   $this->handleCompoundCommand($command);
            }
        }
    }

    public function handleCompoundCommand(string $command): void
    {
        switch ($command) {
            case "":
                echo "Empty command!\n";
                break;
            case str_starts_with($command, CompoundCommand::SHOW_NODE):
                $this->compoundCommandFactory->create(CompoundCommand::SHOW_NODE)->execute($command);
                break;
            case str_starts_with($command, CompoundCommand::INSERT_NODE):
                $this->compoundCommandFactory->create(CompoundCommand::INSERT_NODE)->execute($command);
                break;
            case str_starts_with($command, CompoundCommand::DELETE_NODE):
                $this->compoundCommandFactory->create(CompoundCommand::DELETE_NODE)->execute($command);
                break;
            case str_starts_with($command, CompoundCommand::UPDATE_NODE):
                $this->compoundCommandFactory->create(CompoundCommand::UPDATE_NODE)->execute($command);
                break;
            case str_starts_with($command, CompoundCommand::RENAME_NODE):
                $this->compoundCommandFactory->create(CompoundCommand::RENAME_NODE)->execute($command);
                break;
            case str_starts_with($command, CompoundCommand::MOVE_NODE):
                $this->compoundCommandFactory->create(CompoundCommand::MOVE_NODE)->execute($command);
                break;
            case str_starts_with($command, CompoundCommand::CLONE_NODE):
                $this->compoundCommandFactory->create(CompoundCommand::CLONE_NODE)->execute($command);
                break;
            default:
               echo "Command not found!\n";
        }
    }
}
