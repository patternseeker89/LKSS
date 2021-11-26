<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;
use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Console\Commands\Validation\Rules\UpdateNodeRule;
use LKSS\Storage\StorageTree;

class UpdateNodeCommand extends AbstractCompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
        $rule = new UpdateNodeRule();
        $this->validator = new CommandValidator($rule, self::UPDATE_NODE);
        $this->paramsHandler = new CommandParamsHandler($rule, self::UPDATE_NODE);
    }

    public function execute(string $command): void
    {
        if ($this->validator->isValid($command)) {
            $this->paramsHandler->setCommand($command);
            $keyParam = $this->paramsHandler->getCurrentParam();
            $key = ($keyParam == "null") ? null : $keyParam;
            $data = $this->paramsHandler->getCurrentParam();
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
