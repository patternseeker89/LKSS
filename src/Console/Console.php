<?php

namespace LKSS\Console;

use LKSS\StorageTree;

/**
 * Description of Console
 *
 * @author porfirovskiy
 */
class Console {

    public const SHOW_TREE = 'show tree';
    public const EXIT = 'exit';
    
    private StorageTree $storage;
    
    public function __construct(
        StorageTree $storage
    ) {
        $this->storage = $storage;
    }

    public function bash() {
        while (true) {
            $command = readline("> ");

            if ($command == ConsoleCommand::EXIT) {
                exit(0);
            } elseif ($command == ConsoleCommand::SHOW_TREE) {
                echo ".\n";
                echo "|\n";
                $this->storage->printTree($this->storage->getRoot(), "|");
                echo "\n";
            } else {
                echo $command . "\n";
            }
        }
    }
}
