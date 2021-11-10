<?php

namespace LKSS\Console\Commands\Validation;

use LKSS\Console\Commands\Validation\Rules\Rule;
use LKSS\Console\Commands\CommandHandler;
use LKSS\Console\Commands\Validation\ParamType;

class CommandValidator
{
    private CommandHandler $commandHandler;
    private RegexExpressionBuilder $builder;

    public function __construct()
    {
        $this->commandHandler = new CommandHandler();
        //drop from dependencies, cretae from new()
        $this->builder = new RegexExpressionBuilder();
    }

    public function isValid(string $command, string $commandName, Rule $rule): bool
    {
        $regexExpression = $this->geRuleRegexExpression($command, $rule);
        $commandParams = $this->getCommandParams($command, $commandName);

        return $this->isMatchesTheRule($commandParams, $regexExpression);
    }

    public function geRuleRegexExpression(string $command, Rule $rule): ?string
    {
        $ruleParams = $rule->getParamsList();
        if (!empty($ruleParams)) {
            $builder = $this->builder->createRegexExpression();
            foreach ($ruleParams as $key => $param) {
                $withSpaceSymbol = true;
                if (count($ruleParams) == ($key + 1)) {
                    $withSpaceSymbol = false;
                }

                if ($param == ParamType::SIMPLE) {
                    $builder->addSimpleParamExpression($withSpaceSymbol);
                } elseif ($param == ParamType::COMPOSITE) {
                    $builder->addCompositeParamExpression($withSpaceSymbol);
                }
            }
            $regexExpression = $builder->getRegexExpression();
        } else {
            $regexExpression = null;
        }

        return $regexExpression;
    }

    protected function getCommandParams(string $command, string $commandName): string
    {
        return substr($command, strlen($commandName) + 1);
    }

    protected function isMatchesTheRule(string $commandParams, string $regexExpression): bool
    {
        return (bool)preg_match('/' . $regexExpression . '/', $commandParams);
    }
}
