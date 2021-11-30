<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;
use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Console\Commands\Validation\Rules\InsertNodeRule;
use LKSS\Console\Commands\EditorHandler;
use LKSS\Console\Commands\VerticalCommandParamsHandler;
use LKSS\Storage\StorageTree;

class InsertNodeCommand extends AbstractCompoundCommand
{
    use EditorHandler;

    private StorageTree $storage;

    public function __construct(StorageTree $storage)
    {
        $this->storage = $storage;
        $rule = new InsertNodeRule();
        $this->validator = new CommandValidator($rule, self::INSERT_NODE);
        $this->paramsHandler = new CommandParamsHandler($rule, self::INSERT_NODE);
        $this->verticalParamsHandler = new VerticalCommandParamsHandler();
    }

    public function execute(string $command): void
    {
        $filledParams = $this->verticalParamsHandler->getParams(
            3,
            [
                'parentKey' => VerticalCommandParamsHandler::HANDLER_TYPE_STRING,
                'name' => VerticalCommandParamsHandler::HANDLER_TYPE_STRING,
                'data' => VerticalCommandParamsHandler::HANDLER_TYPE_EDITOR,
            ]
        );

        $parentKey = $filledParams['parentKey'];
        $name = $filledParams['name'];
        $data = $filledParams['data'];
        $this->storage->insertNode($parentKey, null, $name, $data);
        //echo '<pre>';var_dump($parentKey, $name, $data);die();
//        if ($this->validator->isValid($command)) {
//            $this->paramsHandler->setCommand($command);
//            $parentKeyParam = $this->paramsHandler->getCurrentParam();
//            $parentKey = ($parentKeyParam == "null") ? null : $parentKeyParam;
//            $name = $this->paramsHandler->getCurrentParam();
//            $data = $this->paramsHandler->getCurrentParam();
//            $this->storage->insertNode($parentKey, null, $name, $data);
//        } else {
//            echo "Dont valid params!\n";
//        }
    }
}
