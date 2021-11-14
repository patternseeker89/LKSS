<?php

namespace LKSS\Console\Commands;

use LKSS\Console\Commands\Validation\ParamType;
use LKSS\Console\Commands\Validation\Rules\RenameNodeRule;

/**
 * CommandParamsHandler
 */
class CommandHandler
{
    private \SplQueue $paramsQueue;
    private string $commandParamsString;

    private string $simpleParamExpression = '/^[^\s]*/';
    private string $compositeParamExpression = '/".*"$/';

    public function __construct(string $command, string $commandName)
    {
        $this->paramsQueue = new \SplQueue();
        $this->commandParamsString = $this->getCommandParamsString($command, $commandName);
        $this->parse();
    }

    protected function getCommandParamsString(string $command, string $commandName): string
    {
        return substr($command, strlen($commandName) + 1);
    }

    protected function parse(): void
    {
        $ruleParams = (new RenameNodeRule())->getParamsList();
        foreach ($ruleParams as $paramType) {
            $matches = [];
            $currentParam = '';
            if ($paramType == ParamType::SIMPLE) {
                preg_match($this->simpleParamExpression, $this->commandParamsString, $matches);
                $currentParam = $matches[0];
            } elseif ($paramType == ParamType::COMPOSITE) {
                preg_match($this->compositeParamExpression, $this->commandParamsString, $matches);
                $currentParam = trim($matches[0], '"');
            }

            $this->paramsQueue->enqueue($currentParam);
            $this->removeParamFromCommandString($currentParam);
        }
    }

    protected function removeParamFromCommandString(string $param): void
    {
        $this->commandParamsString = substr($this->commandParamsString, strlen($param) + 1);
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
