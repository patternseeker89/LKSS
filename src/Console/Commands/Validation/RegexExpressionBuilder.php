<?php

namespace LKSS\Console\Commands\Validation;

class RegexExpressionBuilder
{
    private string $simpleRegexExpression = '^[^\s]*\s[^\s]*\s[^\s]*$';//first second data
    private string $compositeRegexExpression = '^[^\s]*\s[^\s]*\s".*"$';//first second "df fd   "
    private string $compositeRegexExpression2 = '^[^\s]*\s".*"\s".*"$';//first "sec df ond" "third param"

    private string $simpleParamExpression = '[^\s]*';
    private string $compositeParamExpression = '".*"';
    private string $openParamExpression = '^';
    private string $closeParamExpression = '$';
    private string $spaceSymbol = '\s';

    private string $regexExpression = '';

    public function createRegexExpression(): self
    {
        $this->addOpenParamExpression();
        
        return $this;
    }

    public function getRegexExpression(): string
    {
        $this->addCloseParamExpression();

        return $this->regexExpression;
    }

    public function addSimpleParamExpression(bool $withSpaceSymbol): self
    {
        if ($withSpaceSymbol) {
            $this->regexExpression .= $this->simpleParamExpression . $this->spaceSymbol;
        } else {
            $this->regexExpression .= $this->simpleParamExpression;
        }

        return $this;
    }

    public function addCompositeParamExpression(bool $withSpaceSymbol): self
    {
        if ($withSpaceSymbol) {
            $this->regexExpression .= $this->compositeParamExpression . $this->spaceSymbol;
        } else {
            $this->regexExpression .= $this->compositeParamExpression;
        }
        
        return $this;
    }

    private function addOpenParamExpression(): void
    {
        $this->regexExpression .= $this->openParamExpression;
    }

    private function addCloseParamExpression(): void
    {
        $this->regexExpression .= $this->closeParamExpression;
    }
}
