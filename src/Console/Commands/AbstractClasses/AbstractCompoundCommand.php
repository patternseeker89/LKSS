<?php

namespace LKSS\Console\Commands\AbstractClasses;

use LKSS\Console\Commands\Interfaces\CompoundCommand;
use LKSS\Console\Commands\Validation\CommandValidator;

abstract class AbstractCompoundCommand implements CompoundCommand
{
    protected CommandValidator $validator;

    public function __construct()
    {
        $this->validator = new CommandValidator();
    }
}
