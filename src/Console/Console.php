<?php

namespace LKSS\Console;

use LKSS\Console\Commands\Interfaces\SimpleCommand;
use LKSS\Console\Commands\Interfaces\CompoundCommand;
use LKSS\Console\Commands\Factories\SimpleCommandFactory;
use LKSS\Console\Commands\Factories\CompoundCommandFactory;
use LKSS\Console\Commands\Validation\RegexExpressionBuilder;

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

//        $builder = new RegexExpressionBuilder();
//        $exp = $builder->createRegexExpression()
//                ->addSimpleParamExpression(true)
//                ->addCompositeParamExpression(true)
//                ->addCompositeParamExpression(true)
//                ->addSimpleParamExpression(false)
//                ->getRegexExpression();

        //@TODO make object with params from console(user) like Request in Laravel
        
        //@TODO maybe make trait with validation for Command classes
        
        $validator = new Commands\Validation\CommandValidator();
        $result = $validator->isValid('f gg', new Commands\Validation\Rules\MoveNodeRule());
        var_dump($result);die();
    }

    public function bash(): void
    {
        while (true) {
            $command = readline("> ");

            switch ($command) {
                case SimpleCommand::EXIT:
                    $this->simpleCommandFactory->create(SimpleCommand::EXIT)->execute($command);
                    break;
                case SimpleCommand::SHOW_TREE:
                    $this->simpleCommandFactory->create(SimpleCommand::SHOW_TREE)->execute($command);
                    break;
                case SimpleCommand::SHOW_STORAGE_STATUS:
                    $this->simpleCommandFactory->create(SimpleCommand::SHOW_STORAGE_STATUS)->execute($command);
                    break;
                default:
                   $this->handleCompoundCommand($command);
            }
        }
    }

    public function handleCompoundCommand(string $command): void
    {
        switch ($command) {
            case substr($command, 0, strlen(CompoundCommand::SHOW_NODE)) == CompoundCommand::SHOW_NODE:
                $this->compoundCommandFactory->create(CompoundCommand::SHOW_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(CompoundCommand::INSERT_NODE)) == CompoundCommand::INSERT_NODE:
                $this->compoundCommandFactory->create(CompoundCommand::INSERT_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(CompoundCommand::DELETE_NODE)) == CompoundCommand::DELETE_NODE:
                $this->compoundCommandFactory->create(CompoundCommand::DELETE_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(CompoundCommand::UPDATE_NODE)) == CompoundCommand::UPDATE_NODE:
                $this->compoundCommandFactory->create(CompoundCommand::UPDATE_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(CompoundCommand::RENAME_NODE)) == CompoundCommand::RENAME_NODE:
                $this->compoundCommandFactory->create(CompoundCommand::RENAME_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(CompoundCommand::MOVE_NODE)) == CompoundCommand::MOVE_NODE:
                $this->compoundCommandFactory->create(CompoundCommand::MOVE_NODE)->execute($command);
                break;
            case substr($command, 0, strlen(CompoundCommand::CLONE_NODE)) == CompoundCommand::CLONE_NODE:
                $this->compoundCommandFactory->create(CompoundCommand::CLONE_NODE)->execute($command);
                break;
            default:
               echo $command . "\n";
        }
    }
}
