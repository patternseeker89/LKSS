<?php

namespace LKSS\Console\Commands;

use LKSS\Console\Commands\Validation\ParamType;
use LKSS\Console\Commands\Validation\Rules\Rule;


/**
* VERTICAL COMMAND
* insert node
* key: > 
* name: >
* data: >
*/
class CommandParamsHandler
{
    private Rule $rule;
    private string $commandName;
    private \SplQueue $paramsQueue;
    private string $commandParamsString;

    private string $simpleParamExpression = '/^[^\s]*/';
    private string $compositeParamExpression = '/^"[^"]*"/';

    public function __construct(Rule $rule, string $commandName)
    {
        $this->rule = $rule;
        $this->commandName = $commandName;
        $this->paramsQueue = new \SplQueue();
    }

    public function setCommand(string $command): void
    {
        $this->commandParamsString = $this->getCommandParamsString($command);
        $this->parse();
    }

    protected function getCommandParamsString(string $command): string
    {
        return substr($command, strlen($this->commandName) + 1);
    }

    protected function parse(): void
    {
        $ruleParams = $this->rule->getParamsList();
        foreach ($ruleParams as $paramType) {
            $matches = [];
            $currentParam = '';
            $additionalSymbolsCount = 1;
            if ($paramType == ParamType::SIMPLE) {
                preg_match($this->simpleParamExpression, $this->commandParamsString, $matches);
                $currentParam = $matches[0];
            } elseif ($paramType == ParamType::COMPOSITE) {
                preg_match($this->compositeParamExpression, $this->commandParamsString, $matches);
                $currentParam = $this->trimParam($matches[0]);
                $additionalSymbolsCount = 3;
            }
            $this->paramsQueue->enqueue($currentParam);
            $this->removeParamFromCommandString($currentParam, $additionalSymbolsCount);

        }
    }

    protected function removeParamFromCommandString(string $param, $additionalSymbolsCount): void
    {
        $this->commandParamsString = substr($this->commandParamsString, strlen($param) + $additionalSymbolsCount);
    }

    protected function trimParam(string $param): string
    {
        $param = substr($param, 0, strlen($param) - 1);

        return substr($param, 1, strlen($param) - 1);
    }

    public function getCurrentParam(): ?string
    {
        $param = null;
        if ($this->paramsQueue->count() != 0) {
            $param = $this->paramsQueue->dequeue();
        }

        return $param;
    }
}
