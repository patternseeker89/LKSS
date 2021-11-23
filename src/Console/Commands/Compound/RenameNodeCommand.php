<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;
use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Console\Commands\Validation\Rules\RenameNodeRule;
use LKSS\StorageTree;

class RenameNodeCommand extends AbstractCompoundCommand
{
    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
        $rule = new RenameNodeRule();
        $this->validator = new CommandValidator($rule, self::RENAME_NODE);
        $this->paramsHandler = new CommandParamsHandler($rule, self::RENAME_NODE);
    }

    public function execute(string $command): void
    {
        if ($this->validator->isValid($command)) {
            $this->paramsHandler->setCommand($command);
            $keyParam = $this->paramsHandler->getCurrentParam();
            $key = ($keyParam == "null") ? null : $keyParam;
            $newName = $this->paramsHandler->getCurrentParam();
            $this->storage->renameNode($key, $newName);
        } else {
            echo "Dont valid params!\n";
        }
    }

    protected function setNewNameByEditor(): string
    {
        $file = '/tmp/test.txt';
        system("echo '' > /tmp/test.txt && nano $file > `tty`");
        $data = file_get_contents($file);
        system("rm $file");
        
        return $data;
    }
}
