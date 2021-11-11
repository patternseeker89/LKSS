<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;
use LKSS\Console\Commands\CommandHandler;
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
            echo 'ok\n';
            $commandHandler = new CommandHandler($command, self::RENAME_NODE, $this->validator->getRegexExpression());
            //$commandHandler->getFirstParam($command, self::RENAME_NODE);

//            $paramsString = substr($command, strlen(self::RENAME_NODE) + 1);
//            $params = explode(' ', $paramsString);

//            $keyParam = $commandHandler->getFirstParam($command, self::RENAME_NODE);
//            $key = ($keyParam == "null") ? null : $keyParam;
//            $newName = $this->setNewNameByEditor();
//            $this->storage->renameNode($key, $newName);
        } else {
            //var_dump($this->validator->isValid($command, self::MOVE_NODE));
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
