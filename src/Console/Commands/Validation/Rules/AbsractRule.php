<?php

namespace LKSS\Console\Commands\Validation\Rules;

class AbstractRule implements Rule
{
    private string $commandName = '';

    public function getParamsList(): array
    {
        return [];
    }
    
    public function getCommandName(): string
    {
        return $this->commandName;
    }
}