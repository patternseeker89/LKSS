<?php

namespace LKSS\Console\Commands\Validation\Rules;

class MoveNodeRule extends AbstractRule
{
    public function getParamsList(): array
    {
        return ['simple', 'composite'];
    }
}
