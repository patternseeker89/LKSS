<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Storage\StorageTree;
use LKSS\Console\Commands\Validation\Rules\MoveNodeRule;
use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;

class MoveNodeCommand extends AbstractCompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
        $rule = new MoveNodeRule();
        $this->validator = new CommandValidator($rule, self::MOVE_NODE);
        $this->paramsHandler = new CommandParamsHandler($rule, self::MOVE_NODE);
    }

    public function execute(string $command): void
    {
        if ($this->validator->isValid($command)) {
            $this->paramsHandler->setCommand($command);
            $nodeKeyParam = $this->paramsHandler->getCurrentParam();
            $nodeKey = ($nodeKeyParam == "null") ? null : $nodeKeyParam;
            $targetNodeKey = $this->paramsHandler->getCurrentParam();
            $this->storage->moveNode($nodeKey, $targetNodeKey);
        } else {
            echo "Dont valid params!\n";
        }
    }
}
