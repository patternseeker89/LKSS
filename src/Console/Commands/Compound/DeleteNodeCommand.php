<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;
use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Console\Commands\Validation\Rules\DeleteNodeRule;
use LKSS\StorageTree;

class DeleteNodeCommand extends AbstractCompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
        $rule = new DeleteNodeRule();
        $this->validator = new CommandValidator($rule, self::DELETE_NODE);
        $this->paramsHandler = new CommandParamsHandler($rule, self::DELETE_NODE);
    }

    public function execute(string $command): void
    {
        if ($this->validator->isValid($command)) {
            $this->paramsHandler->setCommand($command);
            $nodeKey = $this->paramsHandler->getCurrentParam();
            $this->storage->deleteNode($nodeKey);
        } else {
            echo "Dont valid params!\n";
        }
    }
}
