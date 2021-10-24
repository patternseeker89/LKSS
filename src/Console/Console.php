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

    public function bash(): void
    {
        while (true) {
            $command = readline("> ");

            switch ($command) {
                case ConsoleCommand::EXIT:
                    exit(0);
                    break;
                case ConsoleCommand::SHOW_TREE:
                    echo ".\n";
                    echo "|\n";
                    $this->storage->printTree($this->storage->getRoot(), "|");
                    echo "\n";
                    break;
                default:
                   $this->handleCommand($command);
            }
        }
    }

    public function handleCommand(string $command): void
    {
        switch ($command) {
            case substr($command, 0, strlen(ConsoleCommand::SHOW_NODE)) == ConsoleCommand::SHOW_NODE:
                $nodeKey = substr($command, strlen(ConsoleCommand::SHOW_NODE) + 1);
                $this->storage->showNode($nodeKey);
                break;
            case substr($command, 0, strlen(ConsoleCommand::INSERT_NODE)) == ConsoleCommand::INSERT_NODE:
                $paramsString = substr($command, strlen(ConsoleCommand::INSERT_NODE) + 1);
                $params = explode(' ', $paramsString);
                //var_dump($paramsString, $params);
                if (count($params) == 3) {
                    $parentKey = $params[0];
                    $name = $params[1];
                    $data = $params[2];
                    $this->storage->insertNode($parentKey, $name, $data);
                } else {
                    echo "Dont valid params!\n";
                }
                break;
            default:
               echo $command . "\n";
        }
    }
}
