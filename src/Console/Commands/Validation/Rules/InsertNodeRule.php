<?php

namespace LKSS\Console\Commands\Validation\Rules;

class InsertNodeRule implements Rule
{
    public function getParamsList(): array
    {
        return ['simple', 'composite', 'composite'];
    }
}