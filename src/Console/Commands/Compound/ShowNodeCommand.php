<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\StorageTree;
use LKSS\Console\Commands\Interfaces\CompoundCommand;

class ShowNodeCommand implements CompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $nodeKey = substr($command, strlen(self::SHOW_NODE) + 1);
        $node = $this->storage->getNodeByKey($nodeKey);

        if (!is_null($node)) {
            echo "\n";
            echo "key: " . $node->getKey() . "\n";
            echo "name: " . $node->getName() . "\n";
            echo "data: \n" . $node->getData() . "\n";
            echo "childs: ";
            echo is_array($node->getChildren()) ? count($node->getChildren()) : 0 . "\n";
            echo "\n" . "\n";
        } else {
            echo "Node does not exist for this key!\n";
        }
    }
}
