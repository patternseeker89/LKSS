<?php

namespace LKSS\Console\Commands;

class CommandHandler
{
    private string $simpleRegexExpression = '^[^\s]*\s[^\s]*\s[^\s]*$';//first second data
    private string $compositeRegexExpression = '^[^\s]*\s[^\s]*\s".*"$';//first second "df fd   "
    private string $compositeRegexExpression2 = '^[^\s]*\s".*"\s".*"$';//first "sec df ond" "third param"

    protected function parse(string $commandString, string $command): array
    {
        $paramsSubString = substr($commandString, strlen($command) + 1);

        return explode(' ', $paramsSubString);
    }

    public function getParamByNumber(string $commandString, string $command, int $number): string
    {
        $params = $this->parse($commandString, $command);

        return isset($params) ? $params[$number] : '';
    }

    public function getListOfParams(string $commandString, string $command): array
    {
        return $this->parse($commandString, $command);
    }

    public function getFirstParam(string $commandString, string $command): string
    {
        $params = $this->parse($commandString, $command);

        return isset($params) ? $params[0] : '';
    }

    public function getSecondParam(string $commandString, string $command): string
    {
        $params = $this->parse($commandString, $command);

        return isset($params) ? $params[1] : '';
    }

    public function parseByRegex(string $commandString, string $command): string
    {
        $paramsSubString = substr($commandString, strlen($command) + 1);
        
        
    }
}
