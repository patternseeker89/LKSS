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
        $this->builder = new RegexExpressionBuilder();
    }

    public function isValid(string $command, Rule $rule): bool
    {
        $regexExpression = $this->geRuleRegexExpression($command, $rule);
        
        //next check command string on rule regex: is valid?
        
        var_dump($regexExpression);die();
        
        return true;
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
    
    public function parseRule(string $command, Rule $rule): array
    {
        $commandParams = $this->commandHandler->getListOfParams($command, '');
        $ruleParams = $rule->getParamsList();

        
        
        
        
        if (count($ruleParams) != count($commandParams)) {
            echo 'Wrong count of command params.';
        }

        foreach ($params as $number => $type) {
            $param = $this->commandHandler->getParamByNumber(
                $command,
                $rule->getCommandName(),
                $number
            );

            if (!$this->isValidType($param, $type)) {
                echo 'Wrong param type.';
            }
        }
    }

    public function isValidType(string $param, string $type): bool
    {
        switch ($type) {
            case ParamType::SIMPLE: return $this->isSimpleType($param);
            case ParamType::COMPOSITE: return $this->isCompositeType($param);
            default:
                throw new Exception('Wrong command type passed.');
        }
    }
}
