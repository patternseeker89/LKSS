<?php

namespace LKSS\Console\Commands;

class CommandHandler
{
    private string $commandParamsString;

    public function __construct(string $command, string $commandName, string $regexExpression)
    {
        $this->commandParamsString = $this->getCommandParamsString($command, $commandName);
        $this->parse($regexExpression);
    }

    protected function getCommandParamsString(string $command, string $commandName): string
    {
        return substr($command, strlen($commandName) + 1);
    }

    public function parse(string $regexExpression): void
    {
        $matches = [];
        var_dump($regexExpression);
        preg_match('/' . $regexExpression . '/', $this->commandParamsString, $matches);
        var_dump($matches);
    }

    public function getListOfParams(string $commandString, string $command): void
    {
//        return $this->parse($commandString, $command);
    }
}
