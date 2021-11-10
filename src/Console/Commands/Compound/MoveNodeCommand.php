<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\StorageTree;
//use LKSS\Console\Commands\Interfaces\CompoundCommand;
use LKSS\Console\Commands\Validation\Rules\MoveNodeRule;
use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;

class MoveNodeCommand extends AbstractCompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        parent::__construct();

        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        var_dump($this->validator->isValid($command, self::MOVE_NODE, new MoveNodeRule()));die();
       // if ($this->validator->isValid($command, self::MOVE_NODE, $rule)) {
            $paramsString = substr($command, strlen(self::MOVE_NODE) + 1);
            $params = explode(' ', $paramsString);
            if (count($params) == 2) {
                $commandHandler = new \LKSS\Console\Commands\CommandHandler();
                $nodeKeyParam = $commandHandler->getFirstParam($command, self::MOVE_NODE);
                $nodeKey = ($nodeKeyParam == "null") ? null : $nodeKeyParam;
                $targetNodeKey = $commandHandler->getSecondParam($command, self::MOVE_NODE);
                $this->storage->moveNode($nodeKey, $targetNodeKey);
            } else {
                echo "Dont valid params!\n";
            }
//        } else {
//            echo "Dont11 valid params!\n";
//        }
    }
}
