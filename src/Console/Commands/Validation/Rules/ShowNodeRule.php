<?php

namespace LKSS\Console\Commands\Validation\Rules;

class ShowNodeRule implements Rule
{
    public function getParamsList(): array
    {
        return ['simple'];
    }
}