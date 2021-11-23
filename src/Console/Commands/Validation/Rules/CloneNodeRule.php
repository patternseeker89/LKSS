<?php

namespace LKSS\Console\Commands\Validation\Rules;

class CloneNodeRule implements Rule
{
    public function getParamsList(): array
    {
        return ['simple', 'simple'];
    }
}
