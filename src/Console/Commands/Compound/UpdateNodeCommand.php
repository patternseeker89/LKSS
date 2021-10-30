<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\StorageTree;
use LKSS\Console\Commands\Interfaces\CompoundCommand;

class UpdateNodeCommand implements CompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
    }

    public function execute(string $command): void
    {
        $paramsString = substr($command, strlen(self::UPDATE_NODE) + 1);
        $params = explode(' ', $paramsString);
        if (count($params) == 1) {
            $key = ($params[0] == "null") ? null : $params[0];
            $data = $this->setNodeData();
            $this->storage->updateNode($key, $data);
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
