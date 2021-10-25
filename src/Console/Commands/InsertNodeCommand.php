<?php

namespace LKSS\Console\Commands;

use LKSS\StorageTree;
use LKSS\Console\ConsoleCommand;

class InsertNodeCommand implements Command
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $paramsString = substr($command, strlen(ConsoleCommand::INSERT_NODE) + 1);
        $params = explode(' ', $paramsString);
        if (count($params) == 2) {
            $parentKey = ($params[0] == "null") ? null : $params[0];
            $name = $params[1];
            $data = $this->setNodeData();
            $this->storage->insertNode($parentKey, $name, $data);
        } else {
            echo "Dont valid params!\n";
        }
    }

    protected function setNodeData(): string
    {
        $file = '/tmp/test.txt';
        system("echo '' > /tmp/test.txt && nano $file > `tty`");
        $data = file_get_contents($file);
        system("rm $file");
        
        return $data;
    }
}
