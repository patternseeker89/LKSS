<?php

namespace LKSS\Console\Commands\Validation\Rules;

class RenameNodeRule implements Rule
{
    public function getParamsList(): array
    {
        return ['simple', 'composite'];
    }
}
