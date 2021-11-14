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
        $this->validator = new CommandValidator(new RenameNodeRule());
    }

    public function execute(string $command): void
    {
        if ($this->validator->isValid($command, self::RENAME_NODE)) {
            $commandParamsHandler = new CommandParamsHandler($command, self::RENAME_NODE);
            $keyParam = $commandParamsHandler->getCurrentParam();
            $key = ($keyParam == "null") ? null : $keyParam;
            $newName = $commandParamsHandler->getCurrentParam();
            //$newName = $this->setNewNameByEditor();
            $this->storage->renameNode($key, $newName);
        } else {
            echo "Dont valid params!\n";
        }
    }

    //setTextByEditor()
    protected function setNewNameByEditor(): string
    {
        $file = '/tmp/test.txt';
        system("echo '' > /tmp/test.txt && nano $file > `tty`");
        $data = file_get_contents($file);
        system("rm $file");
        
        return $data;
    }
}
