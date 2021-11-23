<?php

namespace LKSS\Console\Commands\Validation;

use LKSS\Console\Commands\Validation\Rules\Rule;

class CommandValidator
{
    private Rule $rule;
    private string $commandName;
    private ?string $regexExpression = null;

    public function __construct(Rule $rule, string $commandName)
    {
        $this->rule = $rule;
        $this->commandName = $commandName;
    }

    public function isValid(string $command): bool
    {
        $regexExpression = $this->geRuleRegexExpression();
        $commandParams = $this->getCommandParams($command);

        return $this->isMatchesTheRule($commandParams, $regexExpression);
    }

    protected function geRuleRegexExpression(): ?string
    {
        $ruleParams = $this->rule->getParamsList();
        if (!empty($ruleParams)) {
            $builder = (new RegexExpressionBuilder())->createRegexExpression();
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

        $this->regexExpression = $regexExpression;

        return $regexExpression;
    }

    protected function getCommandParams(string $command): string
    {
        return substr($command, strlen($this->commandName) + 1);
    }

    protected function isMatchesTheRule(string $commandParams, string $regexExpression): bool
    {
        return (bool)preg_match('/' . $regexExpression . '/', $commandParams);
    }

    public function getRule(): Rule
    {
        return $this->rule;
    }

    public function getRegexExpression(): ?string
    {
        return $this->regexExpression;
    }
}
