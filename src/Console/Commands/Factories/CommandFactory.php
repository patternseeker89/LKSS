<?php

namespace LKSS\Console\Commands\Factories;

use LKSS\Console\Commands\Interfaces\Command;

interface CommandFactory
{
    public function create(string $type): Command;
}
