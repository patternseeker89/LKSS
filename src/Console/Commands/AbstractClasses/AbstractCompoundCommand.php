<?php

namespace LKSS\Console\Commands\AbstractClasses;

use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Interfaces\CompoundCommand;
use LKSS\Console\Commands\Validation\CommandValidator;

abstract class AbstractCompoundCommand implements CompoundCommand
{
    protected CommandValidator $validator;
    protected CommandParamsHandler $paramsHandler;
}
