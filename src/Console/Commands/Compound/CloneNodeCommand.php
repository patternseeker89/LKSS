<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;
use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Console\Commands\Validation\Rules\CloneNodeRule;
use LKSS\Storage\StorageTree;

class CloneNodeCommand extends AbstractCompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
        $rule = new CloneNodeRule();
        $this->validator = new CommandValidator($rule, self::CLONE_NODE);
        $this->paramsHandler = new CommandParamsHandler($rule, self::CLONE_NODE);
    }

    public function execute(string $command): void
    {
        if ($this->validator->isValid($command)) {
            $this->paramsHandler->setCommand($command);
            $nodeKeyParam = $this->paramsHandler->getCurrentParam();
            $nodeKey = ($nodeKeyParam == "null") ? null : $nodeKeyParam;
            $targetNodeKey = $this->paramsHandler->getCurrentParam();
            $this->storage->cloneNode($nodeKey, $targetNodeKey);
        } else {
            echo "Dont valid params!\n";
        }
    }
}
