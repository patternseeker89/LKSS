<?php

namespace LKSS\Console\Commands\Validation\Rules;

class DeleteNodeRule implements Rule
{
    public function getParamsList(): array
    {
        return ['simple'];
    }
}