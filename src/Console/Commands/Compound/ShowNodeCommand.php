<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;
use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Console\Commands\Validation\Rules\ShowNodeRule;
use LKSS\Storage\StorageTree;

class ShowNodeCommand extends AbstractCompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
        $rule = new ShowNodeRule();
        $this->validator = new CommandValidator($rule, self::SHOW_NODE);
        $this->paramsHandler = new CommandParamsHandler($rule, self::SHOW_NODE);
    }

    public function execute(string $command): void
    {
        if ($this->validator->isValid($command)) {
            $this->paramsHandler->setCommand($command);
            $nodeKey = $this->paramsHandler->getCurrentParam();
            $node = $this->storage->getNodeByKey($nodeKey);

            if (!is_null($node)) {
                echo "\n";
                echo "\e[90mkey:\033[0m " . $node->getKey() . "\n";
                echo "\e[90mname:\033[0m " . $node->getName() . "\n";
                echo "\e[90mdata:\033[0m \n" . $node->getData() . "\n";
                echo "\e[90mchilds:\033[0m ";
                echo is_array($node->getChildren()) ? count($node->getChildren()) : 0 . "\n";
                echo "\n" . "\n";
            } else {
                echo "Node does not exist for this key!\n";
            }
        } else {
            echo "Dont valid params!\n";
        }
    }
}
