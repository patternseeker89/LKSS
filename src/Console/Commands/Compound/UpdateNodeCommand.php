<?php

namespace LKSS\Console\Commands\Compound;

use LKSS\Console\Commands\AbstractClasses\AbstractCompoundCommand;
use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Console\Commands\Validation\Rules\UpdateNodeRule;
use LKSS\Console\Commands\VerticalCommandParamsHandler;
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
        $this->verticalParamsHandler = new VerticalCommandParamsHandler();
    }

    public function execute(string $command): void
    {
        $filledParams = $this->verticalParamsHandler->getParams(
            2,
            [
                'key' => VerticalCommandParamsHandler::HANDLER_TYPE_STRING,
                'data' => VerticalCommandParamsHandler::HANDLER_TYPE_EDITOR,
            ]
        );

        $key = ($filledParams['key'] == "null") ? null : $filledParams['key'];
        $data = $filledParams['data'];

        $this->storage->updateNode($key, $data);

//        if ($this->validator->isValid($command)) {
//            $this->paramsHandler->setCommand($command);
//            $keyParam = $this->paramsHandler->getCurrentParam();
//            $key = ($keyParam == "null") ? null : $keyParam;
//            $data = $this->paramsHandler->getCurrentParam();
//            $this->storage->updateNode($key, $data);
//        } else {
//            echo "Dont valid params!\n";
//        }
    }
}
