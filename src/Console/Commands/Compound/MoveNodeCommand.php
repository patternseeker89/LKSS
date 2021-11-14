<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\StorageTree;
use LKSS\Console\Commands\Validation\Rules\MoveNodeRule;
use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;

class MoveNodeCommand extends AbstractCompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
        $this->validator = new CommandValidator(new MoveNodeRule());
    }

    public function execute(string $command): void
    {
        if ($this->validator->isValid($command, self::MOVE_NODE)) {
            //$paramsString = substr($command, strlen(self::MOVE_NODE) + 1);
            //$params = explode(' ', $paramsString);

//            $commandHandler = new \LKSS\Console\Commands\CommandParamsHandler();
//            $nodeKeyParam = $commandHandler->getFirstParam($command, self::MOVE_NODE);
//            $nodeKey = ($nodeKeyParam == "null") ? null : $nodeKeyParam;
//            $targetNodeKey = $commandHandler->getSecondParam($command, self::MOVE_NODE);
//            $this->storage->moveNode($nodeKey, $targetNodeKey);
        } else {
            echo "Dont valid params!\n";
        }
    }
}
