<?php

namespace LKSS\Console\Commands\Validation;

use LKSS\Console\Commands\Validation\Rules\Rule;
use LKSS\Console\Commands\CommandHandler;

class CommandValidator
{   
    private CommandHandler $commandHandler;

    public function __construct()
    {
        $this->commandHandler = new CommandHandler();
    }

    public function isValid(string $command, Rule $rule): bool
    {
        $this->parseRule($command, $rule);
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

    /**
     * @TODO make regex
     */
    public function isCompositeType(string $param): bool
    {
        $firstSymbol = substr($param, 1);
        $lastSymbol = substr($param, strlen($param) - 1);

        if ($firstSymbol == '"' && $lastSymbol == '"') {
            return true;
        } else {
            return false;
        }
    }

        /**
     * @TODO make regex
     */
    public function isSimpleType(string $param): bool
    {
        return true;
    }
}
