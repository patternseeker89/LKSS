<?php

namespace LKSS\Console\Commands\Validation;

use LKSS\Console\Commands\Validation\Rules\Rule;

class CommandValidator
{
    private Rule $rule;
    private ?string $regexExpression = null;

    public function __construct(Rule $rule)
    {
        $this->rule = $rule;
    }

    public function isValid(string $command, string $commandName): bool
    {
        $regexExpression = $this->geRuleRegexExpression();
        $commandParams = $this->getCommandParams($command, $commandName);

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

    protected function getCommandParams(string $command, string $commandName): string
    {
        return substr($command, strlen($commandName) + 1);
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
