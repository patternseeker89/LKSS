<?php

namespace LKSS\Console\Commands\Validation\Rules;

class UpdateNodeRule implements Rule
{
    public function getParamsList(): array
    {
        return ['simple', 'composite'];
    }
}