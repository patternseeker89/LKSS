<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;
use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Console\Commands\Validation\Rules\InsertNodeRule;
use LKSS\Storage\StorageTree;

class InsertNodeCommand extends AbstractCompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
        $rule = new InsertNodeRule();
        $this->validator = new CommandValidator($rule, self::INSERT_NODE);
        $this->paramsHandler = new CommandParamsHandler($rule, self::INSERT_NODE);
    }

    public function execute(string $command): void
    {
        if ($this->validator->isValid($command)) {
            $this->paramsHandler->setCommand($command);
            $parentKeyParam = $this->paramsHandler->getCurrentParam();
            $parentKey = ($parentKeyParam == "null") ? null : $parentKeyParam;
            $name = $this->paramsHandler->getCurrentParam();
            $data = $this->paramsHandler->getCurrentParam();
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
