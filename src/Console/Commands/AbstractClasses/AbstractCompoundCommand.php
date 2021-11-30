<?php

namespace LKSS\Console\Commands\AbstractClasses;

use LKSS\Console\Commands\CommandParamsHandler;
use LKSS\Console\Commands\Interfaces\CompoundCommand;
use LKSS\Console\Commands\Validation\CommandValidator;
use LKSS\Console\Commands\VerticalCommandParamsHandler;

abstract class AbstractCompoundCommand implements CompoundCommand
{
    protected CommandValidator $validator;
    protected CommandParamsHandler $paramsHandler;
    protected VerticalCommandParamsHandler $verticalParamsHandler;
}
