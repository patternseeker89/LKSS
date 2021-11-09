<?php

namespace LKSS\Console\Commands\Validation\Rules;

use LKSS\Console\Commands\Interfaces\CompoundCommand;

class MoveNodeRule extends AbstractRule
{
    private string $commandName = CompoundCommand::MOVE_NODE;

    public function getParamsList(): array
    {
        //return ['simple,compositem, simple'];
        //return 'simple,composite, simple';
        return ['simple', 'composite'];
        
//        return [
//            'simple',
//            'simple',
//            'composite',
//        ];
    }
}
