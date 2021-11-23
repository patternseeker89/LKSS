<?php

namespace LKSS\Console\Commands\Validation;

/**
 * Examples of expression
 * '^[^\s]*\s[^\s]*\s[^\s]*$';//first second data
 * '^[^\s]*\s[^\s]*\s".*"$';//first second "df fd   "
 * '^[^\s]*\s".*"\s".*"$';//first "sec df ond" "third param"
 */
class RegexExpressionBuilder
{
    private string $simpleParamExpression = '[^\s]*';
    private string $compositeParamExpression = '"[^"]*"';
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
